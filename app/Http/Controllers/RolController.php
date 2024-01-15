<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::where("estado",1)->get();
        return view('rol.index', compact('roles'));
    }

    public function create()
    {
        return view('rol.create');
    }

    public function store(StoreRolRequest $request)
    {
        $rol=new Rol();
        $rol->mes=$request->mes;
        $rol->gestion=$request->gestion;
        $rol->save();
        return redirect()->route('rol.index')->with('success', 'Rol creado exitosamente.');
    }

    public function show(Rol $rol)
    {
        return view('rol.show', compact('rol'));
    }

    public function edit(Rol $rol)
    {
        return view('rol.edit', compact('rol'));
    }

    public function update(UpdateRolRequest $request, Rol $rol)
    {
        $rol->mes=$request->mes;
        $rol->gestion=$request->gestion;
        $rol->save();
        return redirect()->route('rol.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Rol $rol)
    {
        $rol->estado=0;
        $rol->save();
        return redirect()->route('rol.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
