<?php

namespace App\Services;

use App\Models\Carta;
use App\Models\CartaPlantilla;
use App\Models\Hermano;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CartaRenderService
{
    /**
     * Renderiza una carta en una estructura lista para imprimir (HTML/PDF).
     *
     * Devuelve:
     * - 'meta': datos calculados
     * - 'parrafos': lista de párrafos ya reemplazados
     * - 'firmantes': colección de hermanos (ancianos)
     */
    public function render(Carta $carta): array
    {
        $plantilla = $this->resolvePlantilla($carta);

        $replacements = $this->buildReplacementsHtml($carta);

        $parrafos = $this->renderParrafosHtml($plantilla, $replacements);

        return [
            'meta' => [
                'tipo' => $carta->tipo,
                'fecha' => $carta->fecha,
                'lugar' => $carta->lugar,
                'destino' => $carta->destino_texto,
                'iglesia_origen' => optional($carta->iglesiaOrigen)->nombre,
            ],
            'parrafos' => $parrafos,
            'firmantes' => $this->firmantes(),
        ];
    }

    /**
     * Devuelve los firmantes fijos: hermanos con papel ANCIANO.
     */
    public function firmantes(): Collection
    {
        return Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'ANCIANO');
        })->where('estado', 1)->orderBy('id')->get();
    }

    /**
     * Versión simple para mostrar nombres en el PDF.
     */
    public function firmantesComoTexto(string $separador = "\n"): string
    {
        return $this->firmantes()
            ->map(fn (Hermano $h) => trim($h->nombre . ' ' . $h->apellidos))
            ->filter()
            ->implode($separador);
    }

    private function resolvePlantilla(Carta $carta): CartaPlantilla
    {
        if ($carta->plantilla) {
            return $carta->plantilla;
        }

        return CartaPlantilla::query()
            ->where('tipo', $carta->tipo)
            ->where('activo', true)
            ->orderByDesc('id')
            ->firstOrFail();
    }

    private function buildReplacementsHtml(Carta $carta): array
    {
        $fecha = $carta->fecha instanceof Carbon ? $carta->fecha : Carbon::parse($carta->fecha);
        $fecha = $fecha->locale('es');

        $iglesiaOrigenNombre = optional($carta->iglesiaOrigen)->nombre;

        $destino = null;
        if ($carta->relationLoaded('iglesiaDestino') ? $carta->iglesiaDestino : $carta->iglesiaDestino()->exists()) {
            $destino = optional($carta->iglesiaDestino)->nombre;
        }
        $destino = $destino ?: $carta->destino_texto;

        $motivo = null;
        if ($carta->relationLoaded('motivoCatalogo') ? $carta->motivoCatalogo : $carta->motivoCatalogo()->exists()) {
            $motivo = optional($carta->motivoCatalogo)->motivo;
        }
        $motivo = $motivo ?: ($carta->motivo_texto ?: $carta->motivo);

        $listaHermanos = $carta->relationLoaded('hermanos') ? $carta->hermanos : $carta->hermanos()->get();
        $listaBd = $listaHermanos
            ->map(fn (Hermano $h) => trim($h->nombre . ' ' . $h->apellidos))
            ->filter()
            ->values()
            ->all();

        $manual = $carta->destinatarios_texto;
        $manual = $manual ? trim((string) $manual) : '';
        $manual = $manual !== '' ? str_replace(["\r\n", "\r"], "\n", $manual) : '';
        $manualItems = $this->splitManualList($manual);

        $listaHermanosTexto = implode(', ', array_values(array_filter(array_merge($listaBd, $manualItems))));

        $principal = $carta->relationLoaded('destinatarioPrincipal') ? $carta->destinatarioPrincipal : $carta->destinatarioPrincipal()->first();
        $principalTexto = $principal ? trim($principal->nombre . ' ' . $principal->apellidos) : null;
        $principalTexto = $principalTexto ?: ($carta->destinatario_principal_texto ? trim((string) $carta->destinatario_principal_texto) : null);

        $solicitantes = $carta->relationLoaded('solicitantes') ? $carta->solicitantes : $carta->solicitantes()->get();
        $solicitantesTexto = $solicitantes
            ->map(fn (Hermano $h) => trim($h->nombre . ' ' . $h->apellidos))
            ->filter()
            ->values()
            ->implode(', ');

        return [
            '{{lugar}}' => $this->dato((string) $carta->lugar),
            // Formato pensado para la carta: “18 de enero de 2026”
            '{{fecha}}' => $this->dato($fecha->translatedFormat('j \d\e F \d\e Y')),
            '{{iglesia_origen}}' => $this->dato((string) ($iglesiaOrigenNombre ?? '')),
            '{{destino}}' => $this->dato((string) ($destino ?? '')),
            '{{motivo}}' => $this->dato((string) ($motivo ?? '')),
            '{{lista_hermanos}}' => $this->dato((string) $listaHermanosTexto),
            '{{hermano}}' => $this->dato((string) ($principalTexto ?? '')),
            '{{hermana}}' => $this->dato((string) ($principalTexto ?? '')),
            '{{solicitantes}}' => $this->dato((string) $solicitantesTexto),
        ];
    }

    private function renderParrafosHtml(CartaPlantilla $plantilla, array $replacements): array
    {
        $keys = [
            'parrafo1',
            'parrafo2',
            'parrafo3',
            'parrafo4',
            'parrafo5',
            'parrafo6',
            'parrafo7',
            'parrafo8',
            'parrafo9',
            'parrafo10',
            'parrafo11',
            'parrafo12',
        ];

        $out = [];
        foreach ($keys as $key) {
            $texto = $plantilla->{$key};
            if ($texto === null || trim($texto) === '') {
                continue;
            }

            $html = str_replace(array_keys($replacements), array_values($replacements), $texto);
            $html = $this->nl2brSafe($html);
            $out[] = $html;
        }

        return $out;
    }

    private function dato(string $value): string
    {
        $value = trim($value);
        $escaped = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        return '<span class="dato">' . $escaped . '</span>';
    }

    private function nl2brSafe(string $html): string
    {
        return str_replace(["\r\n", "\r", "\n"], '<br>', $html);
    }

    private function splitManualList(string $manual): array
    {
        $manual = trim($manual);
        if ($manual === '') {
            return [];
        }

        // Acepta: "a, b, c" o "a\n b\n c"
        $manual = str_replace(["\r\n", "\r"], "\n", $manual);
        $parts = preg_split('/[\n,]+/', $manual);

        $items = [];
        foreach ($parts as $p) {
            $p = trim((string) $p);
            if ($p !== '') {
                $items[] = $p;
            }
        }

        return $items;
    }
}
