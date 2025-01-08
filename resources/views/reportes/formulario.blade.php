
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Generar Reporte de Ingresos y Egresos</h1>
    <form action="{{ route('detallecuentas.reporte') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="col-md-6">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
</div>
@endsection
