<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use App\Http\Requests\StorePapelRequest;
use App\Http\Requests\UpdatePapelRequest;

class PapelController extends Controller
{
    public function index()
    {
        $papeles = Papel::where('estado', '1')->get();
        return view('papel.index', compact('papeles'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        return view('papel.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(StorePapelRequest $request)
    {
        $papel = new Papel();
        $papel->papel = $request->papel;
        $papel->save();
        return redirect()->route('papel.index')->with('success', 'Papel creado exitosamente.');
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(Papel $papel)
    {
        return view('papel.show', compact('papel'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(Papel $papel)
    {
        return view('papel.edit', compact('papel'));
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(UpdatePapelRequest $request, Papel $papel)
    {
        $papel->papel = $request->papel;
        $papel->save();
        return redirect()->route('papel.index')->with('success', 'Papel actualizado exitosamente.');
    }

    /**
     * Elimina lógicamente el recurso especificado en el almacenamiento.
     */
    public function destroy(Papel $papel)
    {
        $papel->estado = '0'; // Establecer el estado a 0 para indicar eliminación lógica
        $papel->save();
        return redirect()->route('papel.index')->with('success', 'Papel eliminado exitosamente.');
    }
}
