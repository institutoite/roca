<?php

namespace App\Http\Controllers;

use App\Models\Detallerol;
use App\Models\Rol;
use App\Http\Requests\StoreDetallerolRequest;
use App\Http\Requests\UpdateDetallerolRequest;
use App\Models\Hermano;

class DetallerolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Rol $rol)
    {
        $hermanos=Hermano::all();
        return view("detallerol.createsemanas",compact("rol","hermanos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDetallerolRequest $request)
    {
      //dd($request->all());
        $token = $request->input('_token');

        // Itera sobre las fechas y su información asociada
        for ($i = 1; $i <= 4; $i++) {
            $fecha = $request->input("fecha$i");
            $preside = $request->input("preside$i");
            $ministra = $request->input("ministra$i");
            $detalle = new DetalleRol();
            $detalle->fecha = $fecha;
            $detalle->preside_id = $preside;
            $detalle->ministra_id = $ministra;
            $detalle->rol_id = $request->rol_id;

            $detalle->save();
        }

        return redirect()->route("hermano.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        $detalleAgrupados=$rol->detalles->chunk(4);
        //dd($detalleAgrupados);
        return view("detallerol.show",compact("detalleAgrupados","rol"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detallerol $detallerol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetallerolRequest $request, Detallerol $detallerol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detallerol $detallerol)
    {
        //
    }
}
