@extends('adminlte::page')

@section('title', 'Hermanos')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Listado de Hermanos</div>
                <a href="{{ route('hermano.create') }}" class="btn btn-primary mb-2">Crear Hermano</a>
                <div class="card-body">
                    @if($hermanos->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellidos</th>
                                    <!-- Agrega más columnas según sea necesario -->
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hermanos as $hermano)
                                    <tr>
                                        <td>{{ $hermano->id }}</td>
                                        <td>{{ $hermano->nombre }}</td>
                                        <td>{{ $hermano->apellidos }}</td>
                                        <!-- Agrega más celdas según sea necesario -->
                                        <td>
                                            <div class="d-inline-block">
                                                <a href="{{ route('hermano.edit', $hermano->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                <a href="{{ route('hermano.mostraragregarpapeles', $hermano->id) }}" class="btn btn-primary btn-sm">Agragar</a>
                                                <form action="{{ route('hermano.destroy', $hermano->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a este hermano?')" {{ $hermano->estado ? '' : 'disabled' }}>Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay hermanos registrados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop