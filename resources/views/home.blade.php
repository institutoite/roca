<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roca y Coronado</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    @include('encabezado')
    
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
    

    @include('footer')
  
    <script src="{{ asset('js/howler/howler.min.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>

</body>

</html>
