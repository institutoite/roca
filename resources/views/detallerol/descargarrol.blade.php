<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rol</title>
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
            margin-bottom: 2px;
        }
        .encabezado{
            margin-bottom: 10px;
            
            /* background: rgba(38, 186, 165, 0.8); */
        }
       
        th, td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: left;
            size: 20px;
        }

        .alto5semanas{
            height: 27px;
        }
        .alto4semanas{
            height: 35px;
        }
        .alto3semanas{
            height: 50px;
        }
        .alto{
            height: 15px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .resaltado{
            background: rgb(7, 237, 95);
            color: black;
            font-weight: bold;
        }
        .titulo{
            
            color: black;
            border:2px solid rgba(55, 95, 122,0.5);
            font-size: 1.7em;
        }
        .dato{
            background: rgba(38, 186, 165,0.1);
            color: black;
            border:2px solid rgba(55, 95, 122,0.5);
            height: 30px;
            font-size: 2em;
        }

        /* Otros estilos personalizados según tus necesidades */


    </style>
</head>
<body>
    @foreach ($hermanos as $hermano)
        <div class="page">
            <table class="encabezado">
                <tr>
                    <th class="titulo" >HERMANO</th>
                    <td class="dato">{{  $hermano->nombre." ". $hermano->apellidos }}</td>
                </tr>
                <tr>
                    <th class="titulo">MES</th>
                    <td class="dato">{{ $rol->mes." ".$rol->gestion }}</td>
                </tr>
            </table>
            {{-- <h2>{{   $hermano->nombre." ". $hermano->apellidos}}</h2> --}}
            
            <div class="card">
                
            
                <div class="card-body">
                    
                    @php
                        $semanas=count($detalleAgrupados);
                        switch ($semanas) {
                            case 5:
                                $clasealto="alto5semanas";
                                break;
                            case 4:
                                $clasealto="alto4semanas";
                                break;
                            case 3:
                                $clasealto="alto3semanas";
                                break;
                            default:
                                $clasealto="alto";
                                break;
                        }

                    @endphp

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
                                    
                                    <td class="{{ $clasealto }}">{{ \Carbon\Carbon::parse($detalle->fecha)->isoFormat("L") }}</td>

                                    @switch($loop->iteration)
                                        @case(1)
                                            <td class="{{ $clasealto }}">MIERCOLES [Ministerio]</td>
                                            @break
                                        @case(2)
                                            <td class="{{ $clasealto }}">SÁBADO[Oración]</td>
                                            @break
                                        @case(3)
                                            <td class="{{ $clasealto }}">DOMINGO[Ministerio]</td>
                                            @break
                                        @case(4)
                                            <td class="{{ $clasealto }}">DOMINGO[Predicación]</td>
                                            {{-- <td class="{{ $clasealto }}">{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }}[Predicacion]</td> --}}
                                            @break
                                        @default
                                            
                                    @endswitch
                                        
                                    
                                    @if($detalle->hermanopreside->id==$hermano->id)
                                        <td class="resaltado {{ $clasealto }}">
                                    @else
                                        <td class="{{ $clasealto }}">
                                    @endif
                                        {{ $detalle->hermanopreside->nombre.' '.$detalle->hermanopreside->apellidos }}
                                    </td>
                                    
                                    @if ($detalle->hermanoministra->id==$hermano->id)
                                        <td class="resaltado {{ $clasealto }}">
                                    @else
                                        <td class="{{ $clasealto }}">
                                    @endif
                                        {{ $detalle->hermanoministra->nombre.' '.$detalle->hermanoministra->apellidos }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        
                        {{-- <hr> --}}
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>