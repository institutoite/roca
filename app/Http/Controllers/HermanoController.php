<?php

namespace App\Http\Controllers;

use App\Models\Hermano;
use App\Models\Papel;
use App\Http\Requests\StoreHermanoRequest;
use App\Models\Detallerol;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateHermanoRequest;
use App\Http\Requests\RequestAjax;
use App\Models\Iglesia;

class HermanoController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        $hermanos = Hermano::where('estado','1')->get();
        return view('hermano.index', compact('hermanos'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $iglesias = Iglesia::all(); // Obtiene todas las iglesias
        return view('hermano.create', compact('iglesias'));
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(StoreHermanoRequest $request)
    {
        //dd($request->all());
        $hermano = new Hermano();
        $hermano->nombre= $request->nombre;
        $hermano->apellidos= $request->apellidos;
        $hermano->save();
        return redirect()->route('hermano.index')->with('success', 'Hermano creado exitosamente.');
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(Hermano $hermano)
    {
        return view('hermano.show', compact('hermano'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(Hermano $hermano)
    {
        $iglesias = Iglesia::all();
        return view('hermano.edit', compact('hermano', 'iglesias'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(UpdateHermanoRequest $request, Hermano $hermano)
    {
        $hermano->nombre= $request->nombre;
        $hermano->apellidos= $request->apellidos;
        $hermano->save();
        return redirect()->route('hermano.index')->with('success', 'Hermano actualizado exitosamente.');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(Hermano $hermano)
    {
        $hermano->delete();
        return redirect()->route('hermano.index')->with('success', 'Hermano eliminado exitosamente.');
    }

    public function mostrarAgregarPapeles($idHermano)
    {
        $hermano = Hermano::find($idHermano);
        $papeles = Papel::all();

        return view('hermano.agragarpapeles', compact('hermano', 'papeles'));
    }

    public function agregarPapeles(Request $request, $idHermano)
    {
        $hermano = Hermano::find($idHermano);

        if ($hermano) {
            $papelesSeleccionados = $request->input('papeles', []);

            $hermano->papeles()->sync($papelesSeleccionados);

            return redirect()->route('hermano.index')->with('success', 'Papeles agregados correctamente.');
        } else {
            return redirect()->route('ruta_de_retorno')->with('error', 'Hermano no encontrado.');
        }
    }


    public function asignarPapel(Request $request, $idHermano, $idPapel)
    {

        $hermano = Hermano::find($idHermano);
        $papel = Papel::find($idPapel);

        if ($hermano && $papel) {
            $hermano->papeles()->attach($papel);

            return response()->json(['message' => 'Relación creada correctamente'], 200);
        } else {
            return response()->json(['message' => 'Hermano o papel no encontrado'], 404);
        }
    }

    public function quitarPapel($idHermano, $idPapel)
    {
        $hermano = Hermano::find($idHermano);
        $papel = Papel::find($idPapel);

        if ($hermano && $papel) {
            $hermano->papeles()->detach($papel);

            return response()->json(['message' => 'Relación eliminada correctamente'], 200);
        } else {
            return response()->json(['message' => 'Hermano o papel no encontrado'], 404);
        }
    }

    public function presididores(){
        $presididores = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'PRESIDE');
        })->get();
        return response()->json($presididores);
    }
    public function miercoles(){
        $miercoles = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'MINISTERIO MIERCOLES');
        })->get();
        return response()->json($miercoles);
    }
    public function sabados(){
        $sabados = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'MINISTERIO SABADO');
        })->get();
        return response()->json($sabados);
    }
    public function domingos(){
        $domingos = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'MINISTERIO DOMINGO');
        })->get();
        return response()->json($domingos);
    }
    public function predicadores(){
        $predicadores = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'PREDICACION');
        })->get();
        return response()->json($predicadores);
    }

    public function participantes(RequestAjax $request){
        $detalle = Detallerol::findOrFail($request->id_detalle);
        $evento = $detalle->evento;
        $presididores=$this->presididores();

        $preside=Hermano::findOrFail($detalle->preside_id);
        $ministra=Hermano::findOrFail($detalle->ministra_id);

        switch ($evento) {
            case "miercoles":
                $ministros=$this->miercoles();
                break;
            case "sabados":
                $ministros=$this->sabados();
                break;
            case "domingos":
                $ministros=$this->domingos();
                break;
            case "predicacion":
                $ministros=$this->predicadores();
                break;
            
            default:
                # code...
                break;
        }
        $data=["presididores"=>$presididores,"ministros"=>$ministros,"ministra"=>$ministra,"preside"=>$preside];

        return response()->json($data);
    }
}