<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos - Voluntariado Anónimo para Propagar el Evangelio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        #quienes-somos {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #26baa5;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li::before {
            content: "\2022";
            color: #26baa5;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
@include('encabezado')
<div class="container">

        <section id="quienes-somos">
            <h1>Quiénes Somos</h1>
            <p>Somos un grupo de voluntarios dedicados y apasionados por propagar el evangelio de Jesucristo alrededor del mundo. Nuestro compromiso es difundir el amor, la esperanza y la salvación que se encuentran en la palabra de Dios a través de diversas actividades y proyectos evangelísticos.</p>
            
            <h2>Nuestra Misión</h2>
            <p>Nuestra misión es llevar el mensaje de salvación a todas las naciones, proclamando las buenas nuevas del evangelio y haciendo discípulos de Jesucristo en todas partes. Nos esforzamos por compartir el amor de Dios de manera tangible y relevante, mostrando compasión, cuidado y apoyo a aquellos que necesitan esperanza y sanidad en sus vidas.</p>
            
            <h2>Nuestros Valores</h2>
        
        <ul>
            <li>Fe en Dios</li>
            <li>Amor al prójimo</li>
            <li>Integridad</li>
            <li>Compromiso</li>
            <li>Trabajo en equipo</li>
        </ul>
        
        <h2>Nuestro Trabajo</h2>
        <p>Trabajamos de manera anónima y desinteresada, enfocados en el servicio y el amor hacia los demás. Nuestras actividades incluyen:</p>
        <ul>
            <li>Distribución de literatura bíblica y materiales evangelísticos.</li>
            <li>Organización de eventos y campañas evangelísticas.</li>
            <li>Apoyo y asistencia a comunidades necesitadas.</li>
            <li>Visitas a hospitales, cárceles y hogares de ancianos para llevar esperanza y consuelo.</li>
            <li>Enseñanza y discipulado para fortalecer la fe de aquellos que buscan crecer en su relación con Dios.</li>
        </ul>
        
        <h2>Cómo Puedes Participar</h2>
        <p>¡Tú también puedes ser parte de esta misión! Si compartes nuestra pasión por el evangelio y deseas hacer una diferencia en el mundo, te invitamos a unirte a nosotros como voluntario. No se requieren habilidades especiales, solo un corazón dispuesto a servir y compartir el amor de Cristo con los demás.</p>
        <p>Para más información sobre cómo participar, contáctanos a través de nuestro correo electrónico o visita nuestra página web.</p>
        <p>Juntos, podemos marcar la diferencia y ser portadores de luz en un mundo necesitado de esperanza y redención.</p>
    </section>
</div>
@include('footer')
</body>
</html>
