
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Crear Cuenta</h1>
    <form action="{{ route('cuentas.store') }}" method="POST">
        @csrf
        @include('cuentas.form') {{-- Incluye el formulario --}}
        <button type="submit" class="btn btn-primary">Crear</button>
        <a href="{{ route('cuentas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection



