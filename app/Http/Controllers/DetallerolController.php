<?php

namespace App\Http\Controllers;

use App\Models\Detallerol;
use App\Models\Rol;
use App\Http\Requests\StoreDetallerolRequest;
use App\Http\Requests\UpdateDetallerolRequest;
use App\Models\Hermano;
use Barryvdh\DomPDF\Facade\Pdf;


use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use App\Http\Requests\RequestAjax;

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
        for ($i = 1; $i <= 4*($request->contadorCards+1); $i++) {
            $fecha = $request->input("fecha$i");
            $preside = $request->input("preside$i");
            $ministra = $request->input("ministra$i");

            switch ($i) {
                case 1:
                    $evento="miercoles";
                    break;
                
                case 2:
                    $evento="sabados";
                    break;
                
                case 3:
                    $evento="domingos";
                    break;
                
                case 4:
                    $evento="predicacion";
                    break;
                
                default:
                    # code...
                    break;
            }

            $detalle = new DetalleRol();
            $detalle->fecha = $fecha;
            $detalle->preside_id = $preside;
            $detalle->ministra_id = $ministra;
            $detalle->rol_id = $request->rol_id;
            $detalle->evento = $evento;

            $detalle->save();
        }

        return redirect()->route("detallerol.ver",$detalle->rol_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        
        
        $detalleAgrupados=$rol->detalles->chunk(4);
        // $detalleAgrupados = $rol->detalles->filter(function ($detalle) {
        //     return $detalle->estado == 1;
        // })->chunk(4);
        
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
    public function deletedetalle(RequestAjax $request)
    {
        $detalle=Detallerol::findOrFail($request->id_detalle);
        $detalle->preside_id=1;
        $detalle->ministra_id=1;
        $detalle->save();
        $nuevoPreside=Hermano::findOrFail(1);
        $nuevoMinistro=Hermano::findOrFail(1);
        $data=["nuevopreside"=>$nuevoPreside,"nuevoministro"=>$nuevoMinistro];
        return response()->json($data);
    }
    
    public function descargar(Rol $rol){
        $hermanos=Hermano::has('papeles')->get()->skip(1);
        $data = [
            'title' => 'Mi primer PDF',
            'content' => 'Contenido del PDF...',
            'rol'=>$rol,
            'detalleAgrupados'=>$rol->detalles->chunk(4),
            'hermanos'=>$hermanos,
        ];

        $pdf = PDF::loadView('detallerol.descargarrol', $data);
    
        return $pdf->download($rol->mes."_".$rol->gestion.'.pdf');
    }

    public function updateparcipantes(RequestAjax $request){
        $detalle=Detallerol::findOrFail($request->id_detalle);
        $detalle->preside_id=$request->id_presididor;
        $detalle->ministra_id=$request->id_ministro;
        $detalle->save();
        $nuevoPreside=Hermano::findOrFail($detalle->preside_id);
        $nuevoMinistro=Hermano::findOrFail($detalle->ministra_id);
        $data=["nuevopreside"=>$nuevoPreside,"nuevoministro"=>$nuevoMinistro];
        return response()->json($data);
    }
}

