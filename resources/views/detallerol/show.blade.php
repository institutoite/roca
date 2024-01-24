
@extends('adminlte::page')
@section('title', 'Hermanos')


@section('content')
    <div class="card">
        <a href="{{ route('descargar.rol',$rol->id )}}">Descargar</a>
        <div class="card-header">
            {{  $rol->mes." ". $rol->gestion}}
        </div>
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
                            <td>{{ $detalle->hermanopreside->nombre.' '.$detalle->hermanopreside->apellidos }}</td>
                            <td>{{ $detalle->hermanoministra->nombre.' '.$detalle->hermanoministra->apellidos }}</td>
                        </tr>
                    @endforeach
                </table>
            @endforeach
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@stop







