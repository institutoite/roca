
@extends('adminlte::page')

@section('title', 'Hermanos')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Hermano</div>

                <div class="card-body">
                    <form action="{{ route('hermano.update', $hermano->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('hermano.form')
                    </form>
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

