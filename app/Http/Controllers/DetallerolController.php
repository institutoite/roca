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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Detallerol $detallerol)
    {
        //
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
