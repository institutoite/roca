@extends('adminlte::page')
@section('content')
<div class="container">
    <h1>Reporte de Ingresos y Egresos</h1>
    <p>Desde: {{ $reportes[0]['fechaInicio'] }} | Hasta: {{ $reportes[0]['fechaFin'] }}</p>
    <a href='{{ route("reporte.pdf", ["fechaInicio" =>$reportes[0]['fechaInicio'] , "fechaFin" => $reportes[0]['fechaFin']]) }}'' class="btn btn-primary mb-3">
        Imprimir PDF
     </a> 
    
    @foreach ($reportes as $reporte)
        <h2>Mes: {{ $reporte['mes'] }}</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Ingreso</th>
                    <th>Egreso</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $saldo=0;
                @endphp

                @foreach ($reporte['detalles'] as $detalle)
                    <tr>
                        <td>{{ Carbon\Carbon::parse($detalle->fecha)->format('d-m-Y') }}</td>
                        <td>{{ $detalle->descripcion }}</td>
                        @if ($detalle->cuenta->tipo=='ingreso')
                            <td>{{ number_format($detalle->monto, 2) }} Bs.</td>
                            <td></td>
                            @php
                                // $saldo=$saldo + (float)$detalle->monto;
                                $saldo=$saldo + $detalle->monto;
                            @endphp
                        @else
                            <td></td>
                            <td>{{ number_format($detalle->monto, 2) }} Bs.</td>
                            @php
                                $saldo=$saldo-(float)$detalle->monto;
                                
                            @endphp
                        @endif
                        <td>{{ number_format($saldo, 2) }} Bs.</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Ingresos</th>
                    <th>{{ number_format($reporte['total_ingresos'], 2) }} Bs.</th>
                </tr>
                <tr>
                    <th colspan="3">Total Egresos</th>
                    <th>{{ number_format($reporte['total_egresos'], 2) }} Bs.</th>
                </tr>
                <tr>
                    <th colspan="3">Saldo</th>
                    <th>{{ number_format($reporte['saldototal'], 2) }} Bs.</th>
                </tr>
            </tfoot>
        </table>
    @endforeach
</div>
@endsection
