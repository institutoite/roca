<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Contenedor principal */
        .container {
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        /* Títulos */
        h1 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5rem;
            color: #555;
            margin-top: 20px;
        }

        /* Párrafos */
        p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
        }

        /* Botón */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tfoot th {
            text-align: right;
            font-weight: bold;
            background-color: #f4f4f4;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de Ingresos y Egresos</h1>
        <p>Desde: {{ $reportes[0]['fechaInicio'] }} | Hasta: {{ $reportes[0]['fechaFin'] }}</p>
    
        @foreach ($reportes as $reporte)
            <h2>Mes: {{ $reporte['mes'] }}</h2>
            <table>
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

</body>
</html>