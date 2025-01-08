<?php

namespace App\Http\Controllers;

use App\Models\Detallecuenta;
use App\Http\Requests\StoreDetallecuentaRequest;
use App\Http\Requests\UpdateDetallecuentaRequest;
use App\Http\Requests\RequestConsulta;
use App\Models\Cuenta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Client\Request;

class DetallecuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cuenta $cuenta)
    {
        $detalles = $cuenta->detalles; // Relación definida en el modelo Cuenta
        return view('detalles.index', compact('cuenta', 'detalles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Cuenta $cuenta)
    {
        return view('detalles.create', compact('cuenta'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDetallecuentaRequest $request, Cuenta $cuenta)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas,id',
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
        ]);
    
        $detalle = new DetalleCuenta();
        $detalle->cuenta_id = $request->get('cuenta_id');
        $detalle->user_id = Auth::id();
        $detalle->monto = $request->get('monto');
        $detalle->descripcion = $request->get('descripcion');
        $detalle->fecha = $request->get('fecha');
        $detalle->save();

    
        return redirect()->back()->with('success', 'Detalle registrado correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Detallecuenta $detallecuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuenta $cuenta, DetalleCuenta $detalle)
    {
        return view('detalles.edit', compact('cuenta', 'detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetallecuentaRequest $request, Detallecuenta $detalle, Cuenta $cuenta)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
            'fecha' => 'required|date',
        ]);

        $detalle->update($request->all());

        return redirect()->route('cuentas.detalles.index', $cuenta)->with('success', 'Detalle actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detallecuenta $detalle,Cuenta $cuenta)
    {
        $detalle->delete();

        return redirect()->route('cuentas.detalles.index', $cuenta)->with('success', 'Detalle eliminado exitosamente.');
    }

    public function reporte(RequestConsulta $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;
        $reportes = $this->obtenerDatosDeReporte($fechaInicio, $fechaFin);
        
        //dd($reportes);
        return view('reportes.detallecuentas', compact('reportes'));
    }


    public function obtenerDatosDeReporte($fechaInicio,$fechaFin){
        $saldoObj = DB::table('detallecuentas')
                ->join('cuentas', 'detallecuentas.cuenta_id', '=', 'cuentas.id')
                ->selectRaw("
                    SUM(CASE WHEN cuentas.tipo = 'ingreso' THEN detallecuentas.monto ELSE 0 END) - 
                    SUM(CASE WHEN cuentas.tipo = 'egreso' THEN detallecuentas.monto ELSE 0 END) as saldo
                ")
                ->where('detallecuentas.user_id', Auth::id())
                ->where('detallecuentas.fecha', '<', $fechaInicio)
                ->first();
                $saldo = $saldoObj->saldo; 
        $saldoTotalObjeto = DB::table('detallecuentas')
                ->join('cuentas', 'detallecuentas.cuenta_id', '=', 'cuentas.id')
                ->selectRaw("
                    SUM(CASE WHEN cuentas.tipo = 'ingreso' THEN detallecuentas.monto ELSE 0 END) - 
                    SUM(CASE WHEN cuentas.tipo = 'egreso' THEN detallecuentas.monto ELSE 0 END) as saldo
                ")
                ->where('detallecuentas.user_id', Auth::id())
                ->where('detallecuentas.fecha', '<', $fechaFin)
                ->first();
            $saldoTotal = $saldoTotalObjeto->saldo; 

            
        $ingreso = DB::table('detallecuentas')
            ->join('cuentas', 'detallecuentas.cuenta_id', '=', 'cuentas.id')
            ->selectRaw("
                SUM(CASE WHEN cuentas.tipo = 'ingreso' THEN detallecuentas.monto ELSE 0 END) as ingreso
            ")
            ->where('detallecuentas.user_id','=',Auth::id())
            ->where('detallecuentas.fecha', '<=', $fechaFin)
            ->first();

            $egreso = DB::table('detallecuentas')
            ->join('cuentas', 'detallecuentas.cuenta_id', '=', 'cuentas.id')
            ->selectRaw("
                SUM(CASE WHEN cuentas.tipo = 'egreso' THEN detallecuentas.monto ELSE 0 END) as egreso
            ")
            ->where('detallecuentas.user_id','=', Auth::id())
            ->where('detallecuentas.fecha', '<=', $fechaFin)
            ->first();


        // Obtener meses únicos en el rango
        $meses = DetalleCuenta::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->selectRaw("DATE_FORMAT(fecha, '%Y-%m') as mes")
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('mes');

        // Generar datos para cada mes
        $reportes = [];
        foreach ($meses as $mes) {
            $detalles = DetalleCuenta::whereBetween('fecha', [$fechaInicio, $fechaFin])
                ->whereRaw("DATE_FORMAT(fecha, '%Y-%m') = ?", [$mes])
                ->where('user_id', Auth::id()) // Filtrar por el usuario autenticado
                ->get();
        
            

        $totalIngresos = $detalles->where('tipo', 'ingreso')->sum('monto');
        $totalEgresos = $detalles->where('tipo', 'egreso')->sum('monto');

            $reportes[]= [
                'mes' => $mes,
                'detalles' => $detalles,
                'total_ingresos' => $ingreso->ingreso,
                'total_egresos' => $egreso->egreso,
                'saldototal' => $ingreso->ingreso-$egreso->egreso,
                'saldo' => $saldo,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
            ];
        }
        return $reportes;
    }

    public function generarPDF($fechaInicio, $fechaFin)
    {
        // Obtener los datos del reporte según las fechas
        $reportes = $this->obtenerDatosDeReporte($fechaInicio, $fechaFin);
    
        //dd($fechaFin);
        // Generar el PDF
        $pdf = PDF::loadView('reportes.detalleimprimir', compact('fechaInicio', 'fechaFin', 'reportes'));
    
        // Descargar el PDF
        return $pdf->download('reporte_ingresos_egresos.pdf');
    }
    
    

}
