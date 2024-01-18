
@extends('adminlte::page')

@section('title', 'Hermanos')

@section('content')
    <div class="card">
        <div class="card-header">
            {{  $rol->mes." ". $rol->gestion}}
        </div>
        <div class="card-body">
            @php
                $i=1;
            @endphp

            <table class="table table-bordered table-hover table-striped">
                @foreach ($detalle as $item)
                    @if (($i % 5 == 0)||($i == 1))
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Dia</th>
                                <th>Preside</th>
                                <th>Ministra</th>
                            </tr>
                        </thead>
                    @endif    
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->dia }}</td>
                            <td>{{ $item->hermanopreside->nombre }}</td>
                            <td>{{ $item->hermanoministra->nombre }}</td>
                        </tr>
                    @php
                        $i=$i+1;
                    @endphp        
                @endforeach
            </table>
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







