<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roca y Coronado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    @include('encabezado')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 p-3">
            <div class="card">
                <div class="card-header">
                    FORMULARIO SUBIR AUDIO
                </div>
                <div class="card-body">
                    {{-- <form id="formulario" enctype="multipart/form-data">
                        @csrf --}}

                        <span id="status">0%</span>
                        <progress class="" id="progressBar" value="0" max="100"></progress>

                        <div id="mensaje-exito" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Audio subio correctamente!</strong> Un Administrador aprobará el audio subido.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <button id="boton-subir-otro" class="btn btn-outline-info fondoTurqueza">Subir otro Audio</button>
                        </div>
                        <div id="mensaje-fracaso" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>No se pudo subir su audio!</strong> no cumple las validaciones.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @include('form')
                    {{-- </form> --}}
                </div>
            </div>
        </div> 
        <div class="col-12 col-sm-12 col-md-12 col-lg-9">
            <div class="container mt-4">
                <div class="row">
                    @foreach ($pistas as $pista)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <img src="{{ $pista->nombre ? asset('storage/portadas/'.$pista->foto) : asset('storage/portadas/sinfoto.jpg') }}" class="card-img-top" alt="{{ $pista->titulo }}">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <span id="textoLargo" class="card-title">{{ $pista->nombre }}</span>
                                            <p class="card-text">{{ $pista->created_at }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <audio id="audio_{{ $loop->index }}" controls style="width: 100%;">
                                                <source src="{{ asset('storage/audios/'.$pista->audio) }}" type="audio/mpeg">
                                                Tu navegador no soporta el elemento de audio.
                                            </audio>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> 
        
    </div>
    <br>
@include('footer')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/howler/howler.min.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        
        $(document).ready(function() {
                const status = document.getElementById('status');

                document.getElementById("boton-subir-otro").addEventListener("click",function(event){
                    document.getElementById('mensaje-exito').style.display="none";
                    document.getElementById('mensaje-fracaso').style.display="none";
                    document.getElementById('status').style.display = 'none';
                    document.getElementById('progressBar').style.display = 'none';
                    document.getElementById('formulario').style.display = 'block';
                });

                document.getElementById('formulario').addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
                    document.getElementById('progressBar').style.display = 'block';
                    document.getElementById('formulario').style.display = 'none';
                    document.getElementById('status').style.display = 'block';
                    const formData = new FormData(this); // Obtén los datos del formulario
                    // Crea una nueva instancia de XMLHttpRequest
                    const xhr = new XMLHttpRequest();

                    // Escucha el evento de finalización de la carga
                    xhr.addEventListener('load', function() {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                console.log('¡La pista se guardó correctamente!');
                                document.getElementById('mensaje-exito').style.display="block";
                                document.getElementById('formulario').style.display = 'none';
                                document.getElementById('progressBar').style.display = 'none';
                            } else {
                                document.getElementById('mensaje-fracaso').style.display="block";
                            }
                        } else {
                            console.error('Error:', xhr.statusText);
                        }
                    });

                    // xhr.upload.addEventListener('progress', function(event) {
                    //     console.log('Progreso:', event.loaded, '/', event.total);
                    //     const percent = (event.loaded / event.total) * 100;
                    //     progressBar.value = percent;
                    //     status.textContent = percent.toFixed(2) + '%';
                    // });
                    xhr.upload.addEventListener('progress', function(event) {
                        const percent = (event.loaded / event.total) * 100;
                        progressBar.value = percent;
                        status.innerHTML = percent.toFixed(2) + '%'; // Usar innerHTML en lugar de textContent
                    });

                    xhr.open('POST', '{{ route("guardar.pista.ajax") }}'); // Especifica la URL a la que se enviarán los datos
                    xhr.send(formData); // Envía los datos del formulario
                });

        });
    </script>
</body>

</html>

     {{-- $.ajax({
    //     url: '{{ route("guardar.pista.ajax") }}',
    //     type: 'POST',
    //     data: formData,
    //     processData: false,
    //     contentType: false,
    //     success: function(response) {
    //         $('#mensaje').html(response);
    //     },
    //     error: function(xhr, status, error) {
    //         console.error(xhr.responseText);
    //     }
    // }); --}}