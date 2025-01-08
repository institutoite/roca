@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Cuenta</h1>
    <form action="{{ route('cuentas.update', $cuenta) }}" method="POST">
        @csrf
        @method('PUT')
        @include('cuentas.form') {{-- Incluye el formulario --}}
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('cuentas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection