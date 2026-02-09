<?php

namespace App\Console\Commands;

use App\Models\Himno;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportHimnos extends Command
{
    protected $signature = 'himnos:import {--path= : Ruta al JSON o patron} {--truncate : Vaciar la tabla antes de importar}';

    protected $description = 'Importa himnos desde archivos JSON generados por el extractor';

    public function handle(): int
    {
        $pathOption = $this->option('path');
        $pattern = $pathOption ? $pathOption : base_path('himnos_letra_*.json');
        $files = glob($pattern) ?: [];

        if (empty($files)) {
            $this->error('No se encontraron archivos JSON para importar.');
            return Command::FAILURE;
        }

        if ($this->option('truncate')) {
            DB::table('himnos')->truncate();
        }

        $total = 0;
        foreach ($files as $file) {
            $contents = file_get_contents($file);
            $items = json_decode($contents, true);
            if (!is_array($items)) {
                $this->warn("Archivo invalido: {$file}");
                continue;
            }

            foreach ($items as $item) {
                $data = $this->mapItem($item);
                if (empty($data['titulo'])) {
                    continue;
                }

                $unique = [];
                if (!empty($data['numero'])) {
                    $unique = ['numero' => $data['numero']];
                } elseif (!empty($data['url'])) {
                    $unique = ['url' => $data['url']];
                } else {
                    continue;
                }

                Himno::updateOrCreate($unique, $data);
                $total++;
            }
        }

        $this->info("Importados: {$total}");
        return Command::SUCCESS;
    }

    private function mapItem(array $item): array
    {
        $numeroText = $item['numero'] ?? null;
        $numero = $this->parseNumero($numeroText);
        $titulo = $item['titulo'] ?? null;
        $letra = $item['letra'] ?? $this->normalizeFirstLetter((string) $titulo);

        [$estrofas, $coro] = $this->parseEstrofasCoro($item['estrofas_html'] ?? null);

        $informacion = $item['informacion'] ?? null;
        if (!is_array($informacion)) {
            $informacion = null;
        }

        $knownKeys = [
            'numero',
            'titulo',
            'estrofas_html',
            'estrofas_texto',
            'url',
            'letra',
            'informacion',
        ];
        $datos = array_diff_key($item, array_flip($knownKeys));
        if (empty($datos)) {
            $datos = null;
        }

        return [
            'numero' => $numero,
            'numero_text' => $numeroText,
            'titulo' => $titulo,
            'letra' => $letra,
            'estrofas_html' => $item['estrofas_html'] ?? null,
            'estrofas_texto' => $item['estrofas_texto'] ?? null,
            'estrofas' => $estrofas,
            'coro' => $coro,
            'url' => $item['url'] ?? null,
            'informacion' => $informacion,
            'datos' => $datos,
        ];
    }

    private function parseNumero(?string $value): ?int
    {
        if (!$value) {
            return null;
        }
        $digits = preg_replace('/\D+/', '', $value);
        return $digits === '' ? null : (int) $digits;
    }

    private function normalizeFirstLetter(string $text): ?string
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        if ($text === false) {
            return null;
        }
        $text = trim($text);
        $len = strlen($text);
        for ($i = 0; $i < $len; $i++) {
            $ch = $text[$i];
            if (ctype_alpha($ch)) {
                return strtoupper($ch);
            }
        }
        return null;
    }

    private function parseEstrofasCoro(?string $html): array
    {
        if (!$html) {
            return [null, null];
        }

        $matches = [];
        preg_match_all('/<p>(.*?)<\/p>/si', $html, $matches);
        $estrofas = [];
        $coros = [];

        foreach ($matches[1] as $block) {
            $text = $this->normalizeHtmlText($block);
            if ($text === '') {
                continue;
            }
            if (preg_match('/^coro\s*:/i', $text)) {
                $text = preg_replace('/^coro\s*:\s*/i', '', $text);
                if ($text !== '') {
                    $coros[] = $text;
                }
            } else {
                $estrofas[] = $text;
            }
        }

        return [
            empty($estrofas) ? null : $estrofas,
            empty($coros) ? null : $coros,
        ];
    }

    private function normalizeHtmlText(string $html): string
    {
        $text = preg_replace('/<\s*br\s*\/?>/i', "\n", $html);
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\n{3,}/', "\n\n", $text);
        return trim($text);
    }
}
