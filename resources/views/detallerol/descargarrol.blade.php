<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol de Reuniones</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm;
            size: letter;
        }

        body {
            font-family:Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.2;
            color: #2c3e50;
        }

        .page {
            position: relative;
            page-break-after: always;
        }

        .header-section {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double #2c3e50;
            padding-bottom: 15px;
        }

        .organization-name {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            letter-spacing: 1px;
        }

        .document-type {
            font-size: 16px;
            color: #34495e;
            margin: 8px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .member-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .member-details th {
            background-color: #34495e;
            color: white;
            text-align: left;
            padding: 7px 12px;
            font-size: 15px;
            width: 15%;
        }

        .member-details td {
            background-color: #f8f9fa;
            padding: 6px 12px;
            font-size: 15px;
            border: 1px solid #dee2e6;
        }

        /* Tabla principal con ajustes según número de semanas */
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        /* Estilos base para la tabla */
        .schedule-table th {
            background-color: #34495e;
            color: white;
            border: 1px solid #2c3e50;
            font-size: 13px;
            padding: 10px 5px;
            text-align: center;
        }

        .schedule-table td {
            border: 1px solid #dee2e6;
            text-align: center;
            font-size: 13px;
            padding: 3px;
        }

        /* Ajustes específicos para 4 semanas */
        .schedule-table.four-weeks td {
            padding: 6px 6px;
            font-size: 16px;
        }

        /* Ajustes específicos para 5 semanas */
        .schedule-table.five-weeks td {
            font-size: 15px;
        }

        /* Estilos para filas con participación */
        .participation-row {
            font-weight: bold;
            font-size: 15px;
        }

        .participation-row td {
            padding: 2px;
        }

        /* Celda específica resaltada */
        .highlighted-cell {
            background-color: #7FD1F7FF;
            font-weight: bold;

        }

        /* Separador de semanas */
        .week-header {
            background-color: rgba(215, 215, 218, 0.5);
            font-weight: bold;
            color: #2c3e50;
            text-align: left;
            padding: 6px 10px !important;
            border-top: 2px solid #093A6CFF !important;
            letter-spacing: 1px;
        }

        /*primer columna */
        .date-column {
            width: 20%;
            background-color: rgba(241, 241, 241, 0.05);
            font-weight: 500;
        }

        .meeting-column {
            width: 30%;
            color: #34495e;
        }

        .person-column {
            width: 25%;
        }

        .footer {
            position: absolute;
            bottom: 15px;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(44, 62, 80, 0.05);
            z-index: -1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    @foreach ($hermanos as $hermano)
    <div class="page">
        <div class="watermark">ROCA Y CORONADO</div>
        
        <div class="header-section">
            <h1 class="organization-name">ROL MENSUAL</h1>
            <div class="document-type">Presididores y ministros</div>
        </div>

        <table class="member-details">
            <tr>
                <th>HERMANO:</th>
                <td colspan="3">{{ $hermano->nombre . " " . $hermano->apellidos }}</td>
            </tr>
            <tr>
                <th>MES:</th>
                <td>{{ $rol->mes }}</td>
                <th>GESTIÓN:</th>
                <td>{{ $rol->gestion }}</td>
            </tr>
        </table>

        @php
            $totalSemanas = count($detalleAgrupados);
        @endphp

        <table class="schedule-table {{ $totalSemanas == 4 ? 'four-weeks' : 'five-weeks' }}">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>REUNIÓN</th>
                    <th>PRESIDE</th>
                    <th>MINISTRA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalleAgrupados as $index => $grupo)
                    <tr>
                        <td colspan="4" class="week-header">SEMANA {{ $index + 1 }}</td>
                    </tr>
                    @foreach($grupo as $detalle)
                    <tr class="{{ $detalle->hermanopreside->id == $hermano->id || $detalle->hermanoministra->id == $hermano->id ? 'participation-row' : '' }}">
                        <td class="date-column">
                            {{ \Carbon\Carbon::parse($detalle->fecha)->isoFormat("DD/MM/YYYY") }}
                        </td>
                        <td class="meeting-column">
                            @switch($loop->iteration)
                                @case(1)
                                    MIÉRCOLES [Ministerio]
                                    @break
                                @case(2)
                                    SÁBADO [Oración]
                                    @break
                                @case(3)
                                    DOMINGO [Ministerio]
                                    @break
                                @case(4)
                                    DOMINGO [Predicación]
                                    @break
                            @endswitch
                        </td>
                        <td class="person-column {{ $detalle->hermanopreside->id == $hermano->id ? 'highlighted-cell' : '' }}">
                            {{ $detalle->hermanopreside->nombre . ' ' . $detalle->hermanopreside->apellidos }}
                        </td>
                        <td class="person-column {{ $detalle->hermanoministra->id == $hermano->id ? 'highlighted-cell' : '' }}">
                            {{ $detalle->hermanoministra->nombre . ' ' . $detalle->hermanoministra->apellidos }}
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Colosenses 3:23 | Y todo lo que hagáis, hacedlo de corazón, como para el Señor y no para los hombres;
        </div>
    </div>
    @endforeach
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol de Reuniones</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm;
            size: letter;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.3;
        }

        .page {
            position: relative;
            page-break-after: always;
        }

        .header-container {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1a237e;
        }

        .church-name {
            color: #1a237e;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }

        .subtitle {
            color: #283593;
            font-size: 14px;
            margin: 5px 0;
        }

        .member-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .member-info th {
            background-color: #1a237e;
            color: white;
            text-align: left;
            padding: 6px 8px;
            width: 15%;
            font-size: 11px;
        }

        .member-info td {
            background-color: #f3f4f6;
            padding: 6px 8px;
            font-size: 11px;
        }

        /* Estilos base para la tabla */
        .schedule-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
        }

        .schedule-table th {
            background-color: #1a237e;
            color: white;
            text-align: center;
            border: 1px solid #1a237e;
        }

        .schedule-table td {
            border: 1px solid #cfd8dc;
            text-align: center;
        }

        /* Estilos específicos para 4 semanas */
        .schedule-table.four-weeks th {
            padding: 8px 6px;
            font-size: 13px;
        }

        .schedule-table.four-weeks td {
            padding: 12px 2px;
            font-size: 13px;
        }

        /* Estilos específicos para 5 semanas */
        .schedule-table.five-weeks th {
            padding: 6px;
            font-size: 10px;
        }

        .schedule-table.five-weeks td {
            padding: 8px 6px;
            font-size: 10px;
        }

        /* Estilos para separadores de semana */
        .week-separator {
            background-color: #e8eaf6;
            border-top: 2px solid #1a237e !important;
            font-weight: bold;
            text-align: left !important;
            padding-left: 10px !important;
            color: #1a237e;
        }

        .week-separator td {
            padding: 6px !important;
        }

        .date-cell {
            background-color: #e8eaf6;
            font-weight: bold;
            width: 20%;
        }

        .meeting-cell {
            width: 30%;
            color: #1a237e;
            font-weight: bold;
        }

        .person-cell {
            width: 25%;
        }

        .highlighted {
            background-color: #c5cae9;
            font-weight: bold;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #666;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(26, 35, 126, 0.03);
            z-index: -1;
        }

        /* Ajustes para mantener todo en una página */
        .four-weeks .week-separator td {
            padding: 4px 6px !important;
        }

        .five-weeks .week-separator td {
            padding: 2px 6px !important;
        }
    </style>
</head>
<body>
    @foreach ($hermanos as $hermano)
    <div class="page">
        <div class="watermark">IGLESIA</div>
        
        <div class="header-container">
            <div class="church-name">IGLESIA EVANGÉLICA</div>
            <div class="subtitle">ROL DE REUNIONES</div>
        </div>

        <table class="member-info">
            <tr>
                <th>HERMANO:</th>
                <td colspan="3">{{ $hermano->nombre . " " . $hermano->apellidos }}</td>
            </tr>
            <tr>
                <th>MES:</th>
                <td>{{ $rol->mes }}</td>
                <th>GESTIÓN:</th>
                <td>{{ $rol->gestion }}</td>
            </tr>
        </table>

        @php
            $totalSemanas = count($detalleAgrupados);
        @endphp

        <table class="schedule-table {{ $totalSemanas == 4 ? 'four-weeks' : 'five-weeks' }}">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>REUNIÓN</th>
                    <th>PRESIDE</th>
                    <th>MINISTRA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalleAgrupados as $index => $grupo)
                    <tr class="week-separator">
                        <td colspan="4">SEMANA {{ $index + 1 }}</td>
                    </tr>
                    @foreach($grupo as $detalle)
                    <tr>
                        <td class="date-cell">
                            {{ \Carbon\Carbon::parse($detalle->fecha)->isoFormat("DD/MM/YYYY") }}
                        </td>
                        <td class="meeting-cell">
                            @switch($loop->iteration)
                                @case(1)
                                    MIÉRCOLES [Ministerio]
                                    @break
                                @case(2)
                                    SÁBADO [Oración]
                                    @break
                                @case(3)
                                    DOMINGO [Ministerio]
                                    @break
                                @case(4)
                                    DOMINGO [Predicación]
                                    @break
                            @endswitch
                        </td>
                        <td class="person-cell {{ $detalle->hermanopreside->id == $hermano->id ? 'highlighted' : '' }}">
                            {{ $detalle->hermanopreside->nombre . ' ' . $detalle->hermanopreside->apellidos }}
                        </td>
                        <td class="person-cell {{ $detalle->hermanoministra->id == $hermano->id ? 'highlighted' : '' }}">
                            {{ $detalle->hermanoministra->nombre . ' ' . $detalle->hermanoministra->apellidos }}
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Documento generado el {{ now()->isoFormat('LL') }} | Uso interno de la Iglesia Evangélica
        </div>
    </div>
    @endforeach
</body>
</html> --}}

{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol de Reuniones</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm; /* Reducimos márgenes para aprovechar espacio */
            size: letter;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.3;
        }

        .page {
            position: relative;
            page-break-after: always;
        }

        .header-container {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1a237e;
        }

        .church-name {
            color: #1a237e;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }

        .subtitle {
            color: #283593;
            font-size: 14px;
            margin: 5px 0;
        }

        .member-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .member-info th {
            background-color: #1a237e;
            color: white;
            text-align: left;
            padding: 6px 8px;
            width: 15%;
            font-size: 11px;
        }

        .member-info td {
            background-color: #f3f4f6;
            padding: 6px 8px;
            font-size: 11px;
        }

        /* Estilos específicos para tablas de 4 semanas */
        .schedule-table.four-weeks {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .schedule-table.four-weeks th {
            background-color: #1a237e;
            color: white;
            padding: 8px 6px;
            font-size: 11px;
            text-align: center;
        }

        .schedule-table.four-weeks td {
            padding: 12px 6px; /* Más alto para 4 semanas */
            font-size: 11px;
            border: 1px solid #cfd8dc;
            text-align: center;
        }

        /* Estilos específicos para tablas de 5 semanas */
        .schedule-table.five-weeks {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .schedule-table.five-weeks th {
            background-color: #1a237e;
            color: white;
            padding: 6px;
            font-size: 10px;
            text-align: center;
        }

        .schedule-table.five-weeks td {
            padding: 8px 6px; /* Más compacto para 5 semanas */
            font-size: 10px;
            border: 1px solid #cfd8dc;
            text-align: center;
        }

        .date-cell {
            background-color: #e8eaf6;
            font-weight: bold;
            width: 20%;
        }

        .meeting-cell {
            width: 30%;
            color: #1a237e;
            font-weight: bold;
        }

        .person-cell {
            width: 25%;
        }

        .highlighted {
            background-color: #c5cae9;
            font-weight: bold;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #666;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(26, 35, 126, 0.03);
            z-index: -1;
        }
    </style>
</head>
<body>
    @foreach ($hermanos as $hermano)
    <div class="page">
        <div class="watermark">ROCA Y CORONADO</div>
        
        <div class="header-container">
            <div class="church-name">IGLESIA EVANGÉLICA</div>
            <div class="subtitle">ROL DE REUNIONES</div>
        </div>

        <table class="member-info">
            <tr>
                <th>HERMANO:</th>
                <td colspan="3">{{ $hermano->nombre . " " . $hermano->apellidos }}</td>
            </tr>
            <tr>
                <th>MES:</th>
                <td>{{ $rol->mes }}</td>
                <th>GESTIÓN:</th>
                <td>{{ $rol->gestion }}</td>
            </tr>
        </table>

        @php
            $totalSemanas = count($detalleAgrupados);
        @endphp

        <table class="schedule-table {{ $totalSemanas == 4 ? 'four-weeks' : 'five-weeks' }}">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>REUNIÓN</th>
                    <th>PRESIDE</th>
                    <th>MINISTRA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalleAgrupados as $grupo)
                    @foreach($grupo as $detalle)
                    <tr>
                        <td class="date-cell">
                            {{ \Carbon\Carbon::parse($detalle->fecha)->isoFormat("DD/MM/YYYY") }}
                        </td>
                        <td class="meeting-cell">
                            @switch($loop->iteration)
                                @case(1)
                                    MIÉRCOLES [Ministerio]
                                    @break
                                @case(2)
                                    SÁBADO [Oración]
                                    @break
                                @case(3)
                                    DOMINGO [Ministerio]
                                    @break
                                @case(4)
                                    DOMINGO [Predicación]
                                    @break
                            @endswitch
                        </td>
                        <td class="person-cell {{ $detalle->hermanopreside->id == $hermano->id ? 'highlighted' : '' }}">
                            {{ $detalle->hermanopreside->nombre . ' ' . $detalle->hermanopreside->apellidos }}
                        </td>
                        <td class="person-cell {{ $detalle->hermanoministra->id == $hermano->id ? 'highlighted' : '' }}">
                            {{ $detalle->hermanoministra->nombre . ' ' . $detalle->hermanoministra->apellidos }}
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Documento generado el {{ now()->isoFormat('LL') }} | Uso interno de la Iglesia Evangélica
        </div>
    </div>
    @endforeach
</body>
</html> --}}


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rol</title>
    <style>

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
            
        }
       
        th, td {
            border: 1px solid #ddd;
            padding: 3px;
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
        .titulo{
            background: rgba(38, 186, 165,0.3);
            color: black;
            border:2px solid rgba(55, 95, 122,0.5);
        }
        .dato{
            background: rgba(38, 186, 165,0.1);
            color: black;
            border:2px solid rgba(55, 95, 122,0.5);
        }



    </style>
</head>
<body>
    @foreach ($hermanos as $hermano)
        <div class="page">
            <table class="encabezado">
                <tr>
                    <th class="titulo" >HERMANO</th>
                    <td class="dato" colspan="3">{{  $hermano->nombre." ". $hermano->apellidos }}</td>
                </tr>
                <tr>
                    <th class="titulo">MES</th>
                    <td class="dato">{{ $rol->mes }}</td>
                    <th class="titulo">GESTION</th>
                    <td class="dato">{{ $rol->gestion }}</td>

                </tr>
               
                
            </table>
            
            <div class="card">
                
            
                <div class="card-body">
                    
                    @foreach($detalleAgrupados as $grupo)
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
                                            <td>MIERCOLES [Ministerio]</td>
                                            @break
                                        @case(2)
                                            <td>SÁBADO[Oración]</td>
                                            @break
                                        @case(3)
                                            <td>DOMINGO[Ministerio]</td>
                                            @break
                                        @case(4)
                                            <td>DOMINGO[Predicación]</td>
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
                        
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</body>
</html> --}}