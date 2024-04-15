<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roca y Coronado</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
       

        .login-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #2980b9;
        }

        header {
            background-color: #26baa5;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #26baa5;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        section {
            padding: 20px;
        }
        a{
            color: #fff;
        }

        footer {
            background-color: #26baa5;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .fondoTurqueza{
            background-color: #26baa5;
            color:#ccc;
        }
        .textoLinks{
            
            color:rgb(55,95,122);
        }


        /*pista*/
        .pista {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            width: 200px;
            text-align: center;
            display: inline-block;
        }
        .pista img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fondoTurqueza">
        <div class="container">
            <a class="navbar-brand" href="#">Gestión de Roles</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link textoLinks" href="#quienes-somos">Quiénes Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link textoLinks" href="#actividades">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link textoLinks" href="#contacto">Contacto</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="query">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Buscar</button>
                </form>
                @guest
                <!-- Mostrar solo si el usuario no está autenticado -->
                <a href="{{ route('login') }}" class="nav-link">Iniciar Sesión</a>
                @else
                <!-- Mostrar solo si el usuario está autenticado -->
                <form action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Cerrar Sesión</button>
                </form>
                @endguest
            </div>
        </div>
    </nav>
    
    
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
                                    <span class="card-title">{{ $pista->nombre }}</span>
                                    <p class="card-text">{{ $pista->created_at }}</p>
                                </div>
                                <div class="card-footer">
                                    {{-- <button onclick="reproducirAudio('{{ asset('storage/audios/'.$pista->audio) }}')">{{ $pista->nombre }}</button> --}}
                                    {{-- <audio id="audioPlayer" controls style="width: 100%;">
                                        <source src="{{ asset('storage/audios/'.$pista->audio) }}" type="audio/mpeg">
                                        Tu navegador no soporta el elemento de audio.
                                    </audio> --}}
                                    {{-- <audio controls style="width: 100%;">
                                        <source src="{{ asset('storage/audios/'.$pista->audio) }}" type="audio/mpeg">
                                        Tu navegador no soporta el elemento de audio.
                                    </audio> --}}

                                    <audio id="audio_{{ $loop->index }}" controls style="width: 100%;">
                                        <source src="{{ asset('storage/audios/'.$pista->audio) }}" type="audio/mpeg">
                                        Tu navegador no soporta el elemento de audio.
                                    </audio>

                                
                                    {{-- <audio controls style="width: 100%;">
                                        <source src="{{ asset($pista->ruta_audio) }}" type="audio/mpeg">
                                        Tu navegador no soporta el elemento de audio.
                                    </audio> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    

    <section id="contacto">
        <h2>Contacto</h2>
        <p>Para más información, contáctenos en: 71039910</p>
    </section>

    <footer>
        <p>Derechos de autor © 2024 David Flores</p>
    </footer>

    <script src="{{ asset('js/howler/howler.min.js') }}"></script>
     <script>
 document.addEventListener('DOMContentLoaded', function() {
    // Variable global para almacenar la instancia de audio actual
    var currentSound = null;

    // Seleccionar todos los botones de reproducción
    var playButtons = document.querySelectorAll('.playBtn');

    // Iterar sobre cada botón y agregar un listener para reproducir la pista correspondiente
    playButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener la ruta de la pista desde el atributo data-src
            var trackSrc = this.getAttribute('data-src');

            // Obtener el índice del audio para detener el anterior
            var trackIndex = this.getAttribute('data-index');

            // Detener el audio anterior si hay alguno reproduciéndose
            if (currentSound !== null) {
                currentSound.stop();
            }

            // Crear una nueva instancia de Howl para reproducir la pista
            currentSound = new Howl({
                src: [trackSrc],
                html5: true, // Forzar el uso de HTML5 Audio
                onend: function() {
                    console.log('Pista completada');
                }
            });

            // Reproducir la pista
            currentSound.play();
        });
    });
});
    // // Obtener el elemento de audio
    // var audioElement = document.getElementById('audioPlayer');

    // // Crear una instancia de Howl utilizando la misma fuente de audio
    // var sound = new Howl({
    //     src: ["{{ asset('storage/audios/'.$pista->audio) }}"],
    //     html5: true, // Forzar el uso de HTML5 Audio
    //     onend: function() {
    //         // Evento que se ejecuta cuando se completa la reproducción
    //         console.log('Pista completada');
    //     }
    // });

    // // Función para reproducir la pista utilizando Howler.js
    // function playAudio() {
    //     sound.play();
    // }

    // // Función para pausar la reproducción utilizando Howler.js
    // function pauseAudio() {
    //     sound.pause();
    // }

    // // Función para avanzar a la siguiente pista
    // function nextTrack() {
    //     // Implementa la lógica para cargar la siguiente pista y reproducirla
    // }

    // // Función para retroceder a la pista anterior
    // function previousTrack() {
    //     // Implementa la lógica para cargar la pista anterior y reproducirla
    // }

    // // Event listeners para los controles adicionales
    // document.getElementById('playBtn').addEventListener('click', function() {
    //     playAudio();
    // });

    // document.getElementById('pauseBtn').addEventListener('click', function() {
    //     pauseAudio();
    // });

    // document.getElementById('nextBtn').addEventListener('click', function() {
    //     nextTrack();
    // });

    // document.getElementById('previousBtn').addEventListener('click', function() {
    //     previousTrack();
    // });
    </script>


</body>

</html>
