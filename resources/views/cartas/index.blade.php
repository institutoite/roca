@extends('adminlte::page')

@section('title', 'Cartas')

@section('content_header')
    <h1>Cartas</h1>
@stop

@section('content')
    <div class="mb-3">
        <a class="btn btn-primary" href="{{ route('cartas.create') }}">Crear carta</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        <th>Destino</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartas as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->tipo }}</td>
                            <td>{{ optional($c->fecha)->format('Y-m-d') }}</td>
                            <td>{{ $c->lugar }}</td>
                            <td>{{ $c->iglesiaDestino?->nombre ?? $c->destino_texto }}</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('cartas.pdf', $c) }}">PDF</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4">No hay cartas todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
