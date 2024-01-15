
@extends('adminlte::page')

@section('title', 'Asignar papeles')

@section('content')
   
  

    <form method="post" action="{{ route('hermano.mostraragregarpapeles', $hermano->id) }}">
        @csrf
        <h2>{{ $hermano->nombre_hermano }}</h2>

        <label for="papeles">Selecciona los Papeles:</label>
        <div>
            <div class="card">
                <div class="card-header">
                    Lista de papeles para asignar
                </div>
                <div class="card-body">
                    @foreach ($papeles as $papel)
                        {{-- <input type="checkbox" name="papeles[]" value="{{ $papel->id }}"> --}}
                        <input type="checkbox" name="papeles[]" value="{{ $papel->id }}" {{ $hermano->papeles->contains($papel) ? 'checked' : '' }}>
                        {{ $papel->papel }}<br>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit">Agregar Papeles</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop



