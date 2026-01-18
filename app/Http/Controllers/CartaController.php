<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use App\Models\CartaMotivo;
use App\Models\Hermano;
use App\Models\Iglesia;
use App\Services\CartaRenderService;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartaController extends Controller
{
    public function index()
    {
        $cartas = Carta::with(['iglesiaDestino'])->orderByDesc('id')->paginate(20);
        return view('cartas.index', compact('cartas'));
    }

    public function create()
    {
        $hermanos = Hermano::where('estado', 1)->orderBy('id')->get()->skip(1);
        $iglesias = Iglesia::orderBy('id')->get();
        $motivos = CartaMotivo::where('estado', 1)->orderBy('id')->get();

        return view('cartas.create', compact('hermanos', 'iglesias', 'motivos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo' => ['required', 'in:multiple,hermano,hermana'],
            'fecha' => ['required', 'date'],
            'lugar' => ['required', 'string', 'max:120'],

            'personas_ids' => ['required', 'array', 'min:1'],
            'personas_ids.*' => ['integer', 'exists:hermanos,id'],

            'iglesia_destino_id' => ['required', 'integer', 'exists:iglesias,id'],

            'carta_motivo_id' => ['required', 'integer', 'exists:carta_motivos,id'],

            // Compatibilidad: ya no se usan directamente (el formulario envía personas_ids)
            'destinatario_principal_id' => ['nullable', 'integer', 'exists:hermanos,id'],
            'hermanos_ids' => ['nullable', 'array'],
            'hermanos_ids.*' => ['integer', 'exists:hermanos,id'],
        ]);

        $motivoFinal = CartaMotivo::find($data['carta_motivo_id'])?->motivo;
        if (!$motivoFinal) {
            return back()->withErrors(['carta_motivo_id' => 'Debe elegir un motivo del catálogo.'])->withInput();
        }

        $personas = array_values(array_filter($data['personas_ids'] ?? []));
        if ($data['tipo'] !== 'multiple' && count($personas) !== 1) {
            return back()->withErrors(['personas_ids' => 'Para carta Hermano/Hermana debes seleccionar solo una persona.'])->withInput();
        }

        if ($data['tipo'] === 'multiple' && count($personas) < 1) {
            return back()->withErrors(['personas_ids' => 'Debe seleccionar al menos un hermano/hermana.'])->withInput();
        }

        $destinatarioPrincipalId = null;
        if ($data['tipo'] !== 'multiple') {
            $destinatarioPrincipalId = $personas[0] ?? null;
            $generoRequerido = $data['tipo'] === 'hermano' ? 'M' : 'F';
            $destinatario = Hermano::query()->whereKey($destinatarioPrincipalId)->first();
            if (!$destinatario || ($destinatario->genero ?? 'M') !== $generoRequerido) {
                return back()->withErrors([
                    'personas_ids' => $data['tipo'] === 'hermano'
                        ? 'Para carta "Hermano" solo se permiten varones (género M).'
                        : 'Para carta "Hermana" solo se permiten mujeres (género F).',
                ])->withInput();
            }
        }

        $carta = Carta::create([
            'tipo' => $data['tipo'],
            'fecha' => $data['fecha'],
            'lugar' => $data['lugar'],
            'iglesia_origen_id' => 1,
            'iglesia_destino_id' => $data['iglesia_destino_id'],
            'destino_texto' => null,

            // Guardamos también el motivo resuelto en el campo legacy "motivo"
            'motivo' => $motivoFinal,
            'carta_motivo_id' => $data['carta_motivo_id'],
            'motivo_texto' => null,

            'destinatario_principal_id' => $destinatarioPrincipalId,
            'destinatario_principal_texto' => null,
            'destinatarios_texto' => null,
        ]);

        if ($data['tipo'] === 'multiple') {
            // Estos son los que aparecerán en el PDF como {{lista_hermanos}}
            $carta->hermanos()->sync($personas);

            // En este sistema, los solicitantes son los mismos seleccionados.
            $carta->solicitantes()->sync($personas);
        } else {
            // En este sistema, el solicitante es el mismo hermano/hermana seleccionado.
            $carta->solicitantes()->sync([$destinatarioPrincipalId]);
            // Aseguramos que no queden registros en la lista múltiple.
            $carta->hermanos()->sync([]);
        }

        return redirect()->route('cartas.pdf', $carta);
    }

    public function pdf(Carta $carta, CartaRenderService $service)
    {
        $carta->load(['iglesiaOrigen', 'iglesiaDestino', 'motivoCatalogo', 'hermanos', 'solicitantes', 'plantilla', 'destinatarioPrincipal']);

        $data = $service->render($carta);

        $pdf = PDF::loadView('cartas.pdf', $data)->setPaper('letter');

        return $pdf->download('carta_' . $carta->id . '.pdf');
    }

    /**
     * Ruta de prueba: crea una carta demo y descarga el PDF.
     * Se habilita solo en local para no exponerlo en producción.
     */
    public function demoPdf(CartaRenderService $service)
    {
        abort_unless(app()->environment('local') || config('app.debug'), 404);

        $carta = Carta::create([
            'tipo' => 'multiple',
            'fecha' => Carbon::now(),
            'lugar' => 'Santa Cruz',
            'destino_texto' => 'Barrio Roca y Coronado',
            'motivo' => 'Visita',
            'iglesia_origen_id' => 1,
        ]);

        // Adjuntar algunos hermanos de ejemplo (si existen)
        $carta->hermanos()->sync([4, 9]);

        return $this->pdf($carta, $service);
    }
}
