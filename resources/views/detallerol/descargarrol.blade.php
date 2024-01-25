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
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .resaltado{
            background: red;
        }

        /* Otros estilos personalizados según tus necesidades */


    </style>
</head>
<body>
    @foreach ($hermanos as $hermano)
        
        <h1>{{  $rol->mes." ". $rol->gestion." ". $hermano->nombre." ". $hermano->apellidos}}</h1>
        <p>Rol de hermanos que presiden y ministran</p>
        <div class="card">
            
        
            <div class="card-body">
                
                @foreach($detalleAgrupados as $grupo)
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Dia</th>
                                <th>Preside</th>
                                <th>Ministra</th>
                            </tr>
                        </thead>
                        @foreach($grupo as $detalle)
                            <tr>
                                <td>{{ $detalle->id }}</td>
                                <td>{{ $detalle->fecha }}</td>
                                <td>{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }}</td>
                                
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
                    
                @endforeach
            </div>
        </div>
        ya temine
    @endforeach
</body>
</html>