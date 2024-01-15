@extends('adminlte::page')

@section('title', 'Papeles')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Listado de papeles</div>
                <a href="{{ route('papel.create') }}" class="btn btn-primary mb-2">Crear Papel</a>
                <div class="card-body">
                    @if($papeles->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Papel</th>
                                    <!-- Agrega más columnas según sea necesario -->
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($papeles as $papel)
                                    <tr>
                                        <td>{{ $papel->id }}</td>
                                        <td>{{ $papel->papel }}</td>
                                        <!-- Agrega más celdas según sea necesario -->
                                        <td>
                                            <div class="d-inline-block">
                                                <a href="{{ route('papel.edit', $papel->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                <form action="{{ route('papel.destroy', $papel->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a este papel?')" {{ $papel->estado ? '' : 'disabled' }}>Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay papeles registrados.</p>
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