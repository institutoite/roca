
@extends('adminlte::page')

@section('title', 'papels')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar papel</div>

                <div class="card-body">
                    <form action="{{ route('papel.update', $papel->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('papel.form')
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

