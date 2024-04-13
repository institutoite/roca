@extends('adminlte::page')

@section('title', 'Hermanos')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Listado de Ministerios</div>
                <a href="{{ route('pista.create') }}" class="btn btn-primary mb-2">Subir Ministerio</a>
                <div class="card-body">
                    @if($pistas->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">TITULO</th>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Reproducciones</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pistas as $pista)
                                    <tr>
                                        <td>{{ $pista->id }}</td>
                                        <td>{{ $pista->nombre }}</td>
                                        <td><img class="crm-profile-pic rounded-circle avatar-100" width="100px" src="{{ $pista->nombre ? asset('storage/portadas/'.$pista->foto) : asset('storage/portadas/sinfoto.jpg') }}"></td>
                                        <td>{{ $pista->hermano->nombre }}</td>
                                        <td>{{ $pista->click }}</td>
                                        <!-- Agrega más celdas según sea necesario -->
                                        <td>
                                            <div class="d-inline-block">
                                                <a href="{{ route('pista.edit', $pista->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                <form action="{{ route('pista.destroy', $pista->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a este pista?')" {{ $pista->estado ? '' : 'disabled' }}>Eliminar</button>
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