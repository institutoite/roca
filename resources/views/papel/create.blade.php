
@extends('adminlte::page')

@section('title', 'Papel')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Papel</div>

                <div class="card-body">
                    <form action="{{ route('papel.store') }}" method="POST">
                        @csrf
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







