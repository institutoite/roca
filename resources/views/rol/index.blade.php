@extends('adminlte::page')

@section('title', 'Hermanos')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Listado de roles</div>
                <a href="{{ route('rol.create') }}" class="btn btn-primary mb-2">Crear Rol nuevo</a>
                <div class="card-body">
                    @if($roles->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">mes</th>
                                    <th scope="col">gestion</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $rol)
                                    <tr>
                                        <td>{{ $rol->id }}</td>
                                        <td>{{ $rol->mes }}</td>
                                        <td>{{ $rol->gestion }}</td>
                                        <!-- Agrega más celdas según sea necesario -->
                                        <td>
                                            <div class="d-inline-block">
                                                <a href="{{ route('rol.edit', $rol->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                <a href="{{ route('detallerol.create', $rol) }}" class="btn btn-primary btn-sm">Generar Detalle</a>
                                                <form action="{{ route('rol.destroy', $rol->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a este rol?')" {{ $rol->estado ? '' : 'disabled' }}>Eliminar</button>
                                                </form>
                                                <a href="{{ route('detallerol.ver', $rol) }}" class="btn btn-primary btn-sm">Ver Detalle</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay roles registrados.</p>
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