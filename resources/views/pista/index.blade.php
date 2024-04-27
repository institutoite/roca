@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
@stop

@section('title', 'Rocas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Listado de Ministerios</div>
                <a href="{{ route('pista.create') }}" class="btn btn-primary mb-2">Subir Ministerio</a>
                <div class="card-body">
                    @if($pistas->count() > 0)
                        <table id="pistas" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">TITULO</th>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Reproducciones</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pistas as $pista)
                                    <tr id="{{ $pista->id }}">
                                        <td>{{ $pista->id }}</td>
                                        <td>{{ $pista->nombre }}</td>
                                        <td><img class="crm-profile-pic rounded-circle avatar-100" width="100px" src="{{ $pista->nombre ? asset('storage/portadas/'.$pista->foto) : asset('storage/portadas/sinfoto.jpg') }}"></td>
                                        <td>{{ $pista->hermano->nombre }}</td>
                                        <td>{{ $pista->click }}</td>
                                        <!-- Agrega más celdas según sea necesario -->
                                        <td>
                                            <div class="d-inline-block">
                                                <a href="{{ route('pista.edit', $pista->id) }}" class="btn btn-sm"><i class="fa-solid fa-pen-to-square fa-2x" style="color: #fa00f2;"></i></a>
                                                @if ($pista->estado==1)
                                                <a class="btn btn-sm"><i class="fa-regular fa-circle-down fa-2x darbaja" style="color:#14ad00;"></i></a>
                                                @else
                                                <a class="btn btn-sm"><i class="fa-regular fa-circle-up fa-beat fa-2x daralta" style="color: #fb0303;"></i></a>
                                                @endif
                                                <form action="{{ route('pista.destroy', $pista->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro de eliminar a este pista?')" {{ $pista->estado ? '' : 'disabled' }}><i class="fa-solid fa-trash-can fa-2x" style="color: #ff0000;"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay hermanos registrados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
<script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pistas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });

            $("table").on("click",".daralta",function(e){
                e.preventDefault();
                id_pista = $(this).closest('tr').attr("id");
                este=$(this).closest("a");
                $.ajax({
                    url : "{{ route('pista.dar.alta') }}",
                    data : { pista_id : id_pista },
                    type : 'GET',
                    dataType : 'json',
                    success : function(json) {
                        este.html("<i class='fa-regular fa-circle-down fa-2x darbaja' style='color: #14ad00;'></i>");
                        console.log(json);
                    },
                    error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                    },
                });

            });
            $("table").on("click",".darbaja",function(e){
                e.preventDefault();
                id_pista = $(this).closest('tr').attr("id");
                este = $(this).closest("a");
                // console.log($(this).html());
                $.ajax({
                    url : "{{ route('pista.dar.baja') }}",
                    data : { pista_id : id_pista },
                    type : 'GET',
                    dataType : 'json',
                    success : function(json) {
                        este.html("<i class='fa-regular fa-circle-up fa-beat fa-2x daralta' style='color: #fb0303;'></i>");
                        console.log(json);
                    },
                    error : function(xhr, status) {
                        alert('Disculpe, existió un problema');
                    },
                });

            });

        });
    </script>
@stop