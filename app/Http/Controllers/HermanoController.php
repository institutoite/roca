<?php

namespace App\Http\Controllers;

use App\Models\Hermano;
use App\Models\Papel;
use App\Http\Requests\StoreHermanoRequest;
use App\Http\Requests\UpdateHermanoRequest;
use Illuminate\Http\Request;

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
        return view('hermano.create');
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
        return view('hermano.edit', compact('hermano'));
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
    public function ministrosMiercoles(){
        $presididores = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'PRESIDE');
        })->get();
        return response()->json($presididores);
    }
    public function ministrosOracion(){
        $presididores = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'PRESIDE');
        })->get();
        return response()->json($presididores);
    }
    public function ministrosDomingos(){
        $presididores = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'PRESIDE');
        })->get();
        return response()->json($presididores);
    }
    public function Predicacores(){
        $presididores = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'PRESIDE');
        })->get();
        return response()->json($presididores);
    }
}