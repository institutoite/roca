<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta</title>
    <style>
        /*
         |--------------------------------------------------------------------------
         | Configuración de página (DomPDF)
         |--------------------------------------------------------------------------
         | DomPDF respeta @page para márgenes y tamaño de papel.
         | - margin: controla los márgenes del documento
         | - size: tamaño carta (letter)
         */
        @page {
            /*
             | Márgenes del PDF (puedes ajustar cada lado):
             | - top:     margen superior
             | - right:   margen derecho
             | - bottom:  margen inferior
             | - left:    margen izquierdo
             */
            margin-top: 1cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
            margin-left: 2cm;
            size: letter;
        }

        /*
         |--------------------------------------------------------------------------
         | Tipografía base
         |--------------------------------------------------------------------------
         | Definimos la tipografía y tamaño estándar del documento.
         | Esto es el texto “normal” que se verá en la mayoría de párrafos.
         */
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.35;
            color: #111;
        }

        /*
         |--------------------------------------------------------------------------
         | Encabezado fijo
         |--------------------------------------------------------------------------
         | Encabezado institucional requerido.
         | Se divide en 3 líneas con tamaños específicos:
         | - l1: 13pt
         | - l2: 11pt
         | - l3:  9pt
         */
        .encabezado {
            text-align: center;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .encabezado .l1 { font-size: 11pt; }
        .encabezado .l2 { font-size: 9pt; }
        .encabezado .l3 { font-size: 7pt; }

        /*
         |--------------------------------------------------------------------------
         | Resaltado de datos dinámicos
         |--------------------------------------------------------------------------
         | Los valores que provienen de placeholders () se convierten a HTML
         | en el servicio (CartaRenderService) como <span class="dato">...</span>.
         | Requisito: negrita y azul claro, levemente más grande que el texto normal.
         */
        .dato {
            font-weight: 600;
            color: #1776F2;
            font-size: 13pt;
        }

        /*
         |--------------------------------------------------------------------------
         | Párrafos del cuerpo
         |--------------------------------------------------------------------------
         | $parrafos es un array de strings HTML generado por el servicio.
         | Cada párrafo viene con saltos de línea ya convertidos a <br>.
         | Requisito: texto justificado.
         */
        .parrafo {
            margin: 0 0 10px 0;
            text-align: justify;
        }

        /*
         |--------------------------------------------------------------------------
         | Firmantes (Ancianos)
         |--------------------------------------------------------------------------
         | $firmantes es una colección de Hermanos (ancianos) ordenados por ID.
         | Requisito:
         | - Más separación horizontal para firma (2 columnas)
         | - Más separación vertical
         | - Línea horizontal encima del nombre para que firmen
         */
        .firmantes {
            margin-top: 30px;
            font-weight: 600;
        }

        .firmantes-grid {
            margin-top: 18px;
            width: 100%;
            border-collapse: collapse;
        }

        .firmantes-grid td {
            width: 50%;
            padding: 26px 28px 0 28px;
            text-align: center;
            vertical-align: top;
            font-size: 12pt;
        }

        /* Línea de firma sobre el nombre del firmante */
        .firma-linea {
            border-top: 1px solid #787676;
            width: 90%;
            margin: 26px auto 8px auto;
        }

        /* Texto auxiliar (subtítulos) */
        .muted {
            color: #333;
            font-weight: 400;
            font-size: 10pt;
        }
    </style>
</head>
<body>

    <!--
        Encabezado institucional fijo.
        (No depende de variables de la carta, es el encabezado estándar.)
    -->
    <div class="encabezado">
        <div class="l1">IGLESIA EVANGELICA CONGREGADOS EN EL NOMBRE DEL SEÑOR JESUCRISTO</div>
        <div class="l2">PROV. ANDRES IBAÑEZ BARRIO ROCA Y CORONADO</div>
        <div class="l3">Santa Cruz- Bolivia</div>
    </div>
    <br>
    <!--
        Cuerpo de la carta.
        IMPORTANTE: cada elemento de $parrafos ya es HTML seguro generado por el
        servicio (incluye <span class="dato"> para resaltar placeholders).

        Por eso se imprime con (sin escape).
    -->
    @foreach(($parrafos ?? []) as $p)
        <div class="parrafo">{!! $p !!}</div>
    @endforeach

    <!--
        Firmantes:
        - Se muestran en 2 columnas (para dar más espacio horizontal).
        - Cada firma tiene una línea horizontal encima.
        - El orden viene dado por la consulta del servicio (orderBy('id')).
    -->
    <div class="firmantes">
        <div class="muted">Firmantes (Ancianos)</div>
        <table class="firmantes-grid">
            <tr>
                @php $i = 0; @endphp
                @foreach(($firmantes ?? collect()) as $f)
                    <td>
                        <div class="firma-linea"></div>
                        <div>{{ trim($f->nombre.' '.$f->apellidos) }}</div>
                    </td>
                    @php $i++; @endphp
                    @if($i % 2 === 0)
                        </tr><tr>
                    @endif
                @endforeach
                <!-- Si la cantidad es impar, completamos la última fila con una celda vacía -->
                @if($i % 2 !== 0)
                    @for($j = $i % 2; $j < 2; $j++)
                        <td></td>
                    @endfor
                @endif
            </tr>
        </table>
    </div>

</body>
</html>
