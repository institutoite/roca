@extends('adminlte::page')


@section('title', 'Hermanos')

@section('content')
<div class="container">
    <h1>Lista de Cuentas</h1>
    <a href="{{ route('cuentas.create') }}" class="btn btn-primary mb-3">Crear Cuenta</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->id }}</td>
                    <td>{{ $cuenta->nombre }}</td>
                    <td>{{ ucfirst($cuenta->tipo) }}</td>
                    <td>
                        <a href="{{ route('cuentas.edit', $cuenta) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('cuentas.destroy', $cuenta) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detalleModal-{{ $cuenta->id }}">
                            Agregar Detalle
                        </button>
                    </td>
                </tr>
    
                <!-- Modal -->
                <div class="modal fade" id="detalleModal-{{ $cuenta->id }}" tabindex="-1" aria-labelledby="detalleModalLabel-{{ $cuenta->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detalleModalLabel-{{ $cuenta->id }}">Agregar Detalle a {{ $cuenta->nombre }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <form action="{{ route('detallecuentas.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <!-- Input oculto para cuenta_id -->
                                    <input type="hidden" name="cuenta_id" value="{{ $cuenta->id }}">
                                    
                                    <div class="mb-3">
                                        <label for="monto-{{ $cuenta->id }}" class="form-label">Monto</label>
                                        <input type="number" step="0.01" class="form-control" id="monto-{{ $cuenta->id }}" name="monto" required>
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="descripcion-{{ $cuenta->id }}" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion-{{ $cuenta->id }}" name="descripcion"></textarea>
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="fecha-{{ $cuenta->id }}" class="form-label">Fecha</label>
                                        <input type="date" class="form-control" id="fecha-{{ $cuenta->id }}" name="fecha" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    

@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop


