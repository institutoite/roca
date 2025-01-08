
@extends('adminlte::page')

@section('title', 'Hermanos')

@section('content')
<div class="container">
    <h1>Editar {{ $cuenta->tipo == 'ingreso' ? 'Ingreso' : 'Egreso' }} en {{ $cuenta->nombre }}</h1>
    <form action="{{ route('cuentas.detalles.update', [$cuenta, $detalle]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('detalles._form') {{-- Incluye el formulario --}}
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('cuentas.detalles.index', $cuenta) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
