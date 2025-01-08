
@extends('adminlte::page')


@section('title', 'Hermanos')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Hermano</div>

                <div class="card-body">
                    <form action="{{ route('hermano.store') }}" method="POST">
                        @csrf
                        @include('hermano.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script> 
        $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione una iglesia",
            allowClear: true
        });
    });
    </script>
    
@stop







