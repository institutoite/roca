
@extends('adminlte::page')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2-bootstrap.min.css" rel="stylesheet" />
@stop

@section('title', 'Ministerios')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Pista</div>

                <div class="card-body">
                    <form action="{{ route('pista.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('pista.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@stop







