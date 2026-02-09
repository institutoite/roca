@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0">Iglesias</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th style="width: 160px;">Coordenadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($iglesias as $iglesia)
                            <tr>
                                <td>{{ $iglesia->id }}</td>
                                <td>{{ $iglesia->nombre }}</td>
                                <td>{{ $iglesia->Direccion }}</td>
                                <td>
                                    {{ $iglesia->coordenadax ?? '-' }}, {{ $iglesia->coordenaday ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay iglesias registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $iglesias->links() }}
    </div>
</div>
@endsection
