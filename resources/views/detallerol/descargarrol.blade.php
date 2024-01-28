<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
/* pdf-styles.css */

        body {
            font-family: Arial, sans-serif;
        }

        .page {
            width: 100%;
            max-width: 100%;
            margin: 10px;
            page-break-after: always; /* Añadir un salto de página antes de cada elemento con la clase "page" */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            size: 15px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .resaltado{
            background: rgb(7, 237, 95);
            color: black;
        }

        /* Otros estilos personalizados según tus necesidades */


    </style>
</head>
<body>
    @foreach ($hermanos as $hermano)
        <div class="page">
            <h1>{{  $rol->mes." ". $rol->gestion." ". $hermano->nombre." ". $hermano->apellidos}}</h1>
            <p>Rol de hermanos que presiden y ministran</p>
            <div class="card">
                
            
                <div class="card-body">
                    
                    @foreach($detalleAgrupados as $grupo)
                    {{-- {{ $grupo }} --}}
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Dia</th>
                                    <th>Preside</th>
                                    <th>Ministra</th>
                                </tr>
                            </thead>
                            
                            @foreach($grupo as $detalle)
                                <tr>
                                    
                                    <td>{{ \Carbon\Carbon::parse($detalle->fecha)->isoFormat("L") }}</td>

                                    @switch($loop->iteration)
                                        @case(1)
                                            <td>{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }} [Ministerio]</td>
                                            @break
                                        @case(2)
                                            <td>{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }}[Oracion]</td>
                                            @break
                                        @case(3)
                                            <td>{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }}[Ministerio]</td>
                                            @break
                                        @case(4)
                                            <td>{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }}[Predicacion]</td>
                                            @break
                                        @default
                                            
                                    @endswitch
                                        
                                    
                                    @if($detalle->hermanopreside->id==$hermano->id)
                                        <td class="resaltado">
                                    @else
                                        <td>
                                    @endif
                                        {{ $detalle->hermanopreside->nombre.' '.$detalle->hermanopreside->apellidos }}
                                    </td>
                                    
                                    @if ($detalle->hermanoministra->id==$hermano->id)
                                        <td class="resaltado">
                                    @else
                                        <td>
                                    @endif
                                        {{ $detalle->hermanoministra->nombre.' '.$detalle->hermanoministra->apellidos }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>