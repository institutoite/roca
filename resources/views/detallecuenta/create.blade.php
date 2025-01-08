@extends('adminlte::page')
@section('title', 'Hermanos')
@section('content')
<div class="container">
    <h1>Registrar {{ $cuenta->tipo == 'ingreso' ? 'Ingreso' : 'Egreso' }} en {{ $cuenta->nombre }}</h1>
    <form action="{{ route('cuentas.detalles.store', $cuenta) }}" method="POST">
        @csrf
        @include('detalles._form') {{-- Incluye el formulario --}}
        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="{{ route('cuentas.detalles.index', $cuenta) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
