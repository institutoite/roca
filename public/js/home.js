document.addEventListener('DOMContentLoaded', function() {
    var texto = document.getElementById('textoLargo').innerText;
    var caracteresMostrados = 15; // Cambia este valor según tus necesidades
    var textoTruncado = texto.slice(0, caracteresMostrados);
    document.getElementById('textoLargo').innerText = textoTruncado + '...'; // Añade puntos suspensivos al final
});

document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los elementos de audio
    var audioElements = document.querySelectorAll('audio');

    // Agregar listeners para los elementos de audio
    audioElements.forEach(function(audioElement) {
        audioElement.addEventListener('play', function() {
            // Detener la reproducción de cualquier otro audio que se esté reproduciendo
            audioElements.forEach(function(otherAudio) {
                if (otherAudio !== audioElement && !otherAudio.paused) {
                    otherAudio.pause();
                }
            });
        });
    });
});