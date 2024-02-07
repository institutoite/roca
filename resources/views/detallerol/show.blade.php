
@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

@stop
@section('title', 'Hermanos')


@section('content')
    <div class="card">
        <a href="{{ route('descargar.rol',$rol->id )}}">Descargar</a>
        <div class="card-header">
            {{  $rol->mes." ". $rol->gestion}}
        </div>
        <div class="card-body">
            
            @foreach($detalleAgrupados as $grupo)
            <hr>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr class="table-secondary">
                            <th>Fecha</th>
                            <th>Dia</th>
                            <th>Preside</th>
                            <th>Ministra</th>
                            <th>options</th>
                        </tr>
                    </thead>
                    @foreach($grupo as $detalle)
                        <tr id="{{ $detalle->id }}">
                            <td>{{ $detalle->fecha }}</td>
                            {{-- <td>{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }}</td> --}}
                            @switch($loop->iteration)
                            @case(1)
                                <td>MIERCOLES [Ministerio]</td>
                                @break
                            @case(2)
                                <td>SÁBADO[Oración]</td>
                                @break
                            @case(3)
                                <td>DOMINGO[Ministerio]</td>
                                @break
                            @case(4)
                                <td>DOMINGO[Predicación]</td>
                                {{-- <td>{{ \Carbon\Carbon::parse($detalle->fecha)->formatLocalized('%A') }}[Predicacion]</td> --}}
                                @break
                            @default
                                
                        @endswitch
                            <td>{{ $detalle->hermanopreside->nombre.' '.$detalle->hermanopreside->apellidos }}</td>
                            <td>{{ $detalle->hermanoministra->nombre.' '.$detalle->hermanoministra->apellidos }}</td>
                            <td>
                                <i class="editar fa-solid fa-pen-to-square text-warning"></i>
                                &nbsp;
                                <i class="eliminar fa-solid fa-trash-can text-danger"></i>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endforeach
        </div>
    </div>

    {{-- modal para editar el rol  --}}
    <div class="modal fade" id="formeditarrol" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal Crear Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Preside</label>
                        </div>
                        <div class="col-9">
                            <select class="form-control" name="selecpreside" id="selecpreside"></select>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-3">
                            <label for="">Ministra</label>
                        </div>
                        <div class="col-9">
                            <select class="form-control" name="selectministra" id="selectministra"></select>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <div class="container-fluid h-100 mt-3"> 
                        <div class="row w-100 align-items-center">
                            <div class="col text-center">
                                <a href="" id="actualizar" class="btn btn-success">Guardar <i class="far fa-save"></i></a>        
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            let id_detalle;
            // let fila;
            $("table").on("click",".editar",function(){
                id_detalle = $(this).closest('tr').attr('id');
                // console.log(id_detalle);
                $("#formeditarrol").modal("show");

                $.ajax({
                    url : "{{ route('get.participantes')}}",
                    data:{id_detalle:id_detalle},
                    type : 'GET',
                    success : function(respuesta) {
                        console.log(respuesta.preside);
                        // Limpiar selectores
                        $('#selecpreside').empty();
                        $('#selectministra').empty();

                         // Iterar sobre los presididores y agregar opciones al primer select
                        $.each(respuesta.presididores.original, function(index, presididor) {
                            $('#selecpreside').append('<option value="' + presididor.id + '">' + presididor.nombre + '</option>');
                        });

                        // Iterar sobre los ministros y agregar opciones al segundo select
                        $.each(respuesta.ministros.original, function(index, ministro) {
                            $('#selectministra').append('<option value="' + ministro.id + '">' + ministro.nombre + '</option>');
                        });

                        // Seleccionar el valor correspondiente para cada select
                        $('#selecpreside').val(respuesta.preside.id);
                        $('#selectministra').val(respuesta.ministra.id);
                    },
                });
            })

            $("#actualizar").on("click",function(e){
                e.preventDefault();
                $.ajax({
                    url : "{{ route('update.parcipantes')}}",
                    data:{
                            id_detalle:id_detalle,
                            id_ministro:$('#selectministra').val(),
                            id_presididor:$('#selecpreside').val()
                        },
                    type : 'GET',
                    success : function(respuesta) {
                       // Obtener el contenido HTML de la tabla usando el ID proporcionado
                       $("#formeditarrol").modal("hide");
                        var fila = $("#"+id_detalle);
                        var celdapreside = fila.find("td:eq(2)");
                        var celdaministra = fila.find("td:eq(3)");
                        celdapreside.text(respuesta.nuevopreside.nombre+" "+respuesta.nuevopreside.apellidos);
                        celdaministra.text(respuesta.nuevoministro.nombre+" "+respuesta.nuevoministro.apellidos);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Actulizado correctamente",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });
                
            })
            $("table").on("click",".eliminar",function(){
                id_detalle = $(this).closest('tr').attr('id');
               
                        
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: "btn btn-success",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                            });
                            swalWithBootstrapButtons.fire({
                            title: "Estás seguro de eliminar?",
                            text: "Ya no se podra recuperar el registro!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Si, Eliminar!",
                            cancelButtonText: "No, cancelar!",
                            reverseButtons: true
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url : "{{ route('delete.detalle')}}",
                                    data:{
                                            id_detalle:id_detalle,
                                        },
                                    type : 'GET',
                                    success : function(respuesta) {
                                        var fila = $("#"+id_detalle);
                                        var celdapreside = fila.find("td:eq(2)");
                                        var celdaministra = fila.find("td:eq(3)");
                                        celdapreside.text(respuesta.nuevopreside.nombre+" "+respuesta.nuevopreside.apellidos);
                                        celdaministra.text(respuesta.nuevoministro.nombre+" "+respuesta.nuevoministro.apellidos);

                                        swalWithBootstrapButtons.fire({
                                        title: "Borrado!",
                                        text: "Se eliminó correctamente el registro.",
                                        icon: "success"
                                        });
                                    },
                                });

                               
                            } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons.fire({
                                title: "Cancelado",
                                text: "No se eliminó el registro",
                                icon: "error"
                                });
                            }
                        });
                   
                
            })
        })
    </script>
@stop







