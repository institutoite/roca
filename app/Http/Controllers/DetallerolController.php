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
        for ($i = 1; $i <= 4*$request->contadorCards; $i++) {
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
        //setlocale(LC_TIME, 'es_ES');
        //dd(config('app.locale'));//"en"  app\Http\Controllers\DetallerolController.php:60
        //dd($rol->detalles);
        $detalleAgrupados=$rol->detalles->chunk(4);
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
    // public function descargar(Rol $rol)
    // {
    //     // Obtén la colección de hermanos con papeles
    //     $hermanos = Hermano::has('papeles')->get();
    
    //     // Configura DomPDF
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isPhpEnabled', true);
    
    //     $dompdf = new Dompdf($options);
    
    //     // Prepara los datos generales para la vista
    //     $data = [
    //         'title' => 'Mi primer PDF',
    //         'content' => 'Contenido del PDF...',
    //         'rol' => $rol,
    //         'detalleAgrupados' => $rol->detalles->chunk(4),
    //     ];
    
    //     // Itera sobre cada hermano y agrega su contenido a la vista
    //     foreach ($hermanos as $hermano) {
    //         $data['hermano'] = $hermano;  // Pasa el hermano actual a la vista
    
    //         // Carga la vista con los datos
    //         $html = view('detallerol.descargarrol', $data)->render();
    
    //         // Carga el HTML en DomPDF
    //         $dompdf->loadHtml($html);
    
    //         // Establece el tamaño de la página (puedes ajustarlo según tus necesidades)
    //         $dompdf->setPaper('A4', 'portrait');
    
    //         // Renderiza la página
    //         $dompdf->render();
    //     }
    
    //     // Guarda o muestra el PDF, según tus necesidades
    //     $dompdf->stream('archivo.pdf', ['Attachment' => 0]);
    // }
    public function descargar(Rol $rol){
        $hermanos=Hermano::has('papeles')->get();
        $data = [
            'title' => 'Mi primer PDF',
            'content' => 'Contenido del PDF...',
            'rol'=>$rol,
            'detalleAgrupados'=>$rol->detalles->chunk(4),
            'hermanos'=>$hermanos,
        ];

        $pdf = PDF::loadView('detallerol.descargarrol', $data);
    
        return $pdf->download('archivo.pdf');
    }
}

// $options = new Options();
// $options->set('isHtml5ParserEnabled', true);
// $options->set('isPhpEnabled', true);

// $dompdf = new PDF($options);

// foreach ($hermanos as $hermano) {
//     // Inicializa la vista de Blade con el nombre actual
//     $view = View::make('detallerol.descargarrol', ['hermano' => $hermano]);

//     // Renderiza la página
//     $html = $view->render();
//     $dompdf->loadHtml($html);
//     $dompdf->setPaper('letter', 'portrait');
//     // $dompdf->render();

//     // Agrega una nueva página para el siguiente hermano
//     $dompdf->addPage();
// }