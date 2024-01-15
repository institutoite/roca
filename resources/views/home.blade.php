<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roca y Coronado</title>
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
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #555;
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
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>Bienvenido gestion de roles</h1>
    </header>

    <nav>
        <a href="#quienes-somos">Quiénes Somos</a> |
        <a href="#actividades">Actividades</a> |
        <a href="#contacto">Contacto</a>
        @guest
            <!-- Mostrar solo si el usuario no está autenticado -->
            <a href="{{ route('login') }}" class="">Iniciar Sesión</a>
        @else
            <!-- Mostrar solo si el usuario está autenticado -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"> Cerrar Sesión</button>
            </form>
        @endguest
    </nav>
    
    <section id="quienes-somos">
        <h2>Quiénes Somos</h2>
        <p>Somos una congregación dedicada a cultivar la espiritualidad, promover la comunión y brindar apoyo a todos aquellos que buscan un espacio de encuentro con la fe. Nuestra misión es fomentar el amor, la comprensión y el servicio a través de la enseñanza de los principios bíblicos. Nos esforzamos por ser una comunidad acogedora donde cada individuo pueda crecer en su relación con Dios, compartir sus experiencias de fe y contribuir al bienestar de los demás. Juntos, aspiramos a construir un ambiente enriquecedor que inspire la transformación personal y el servicio altruista en beneficio de nuestra comunidad y el mundo que nos rodea.</p>
    </section>

    <section id="actividades">
        <h2>Actividades</h2>
        <ul>
            <li>Reuniones de oración</li>
            <li>Estudio de la Biblia</li>
            <li>Eventos especiales</li>
        </ul>
    </section>

    <section id="contacto">
        <h2>Contacto</h2>
        <p>Para más información, contáctenos en: 71039910</p>
    </section>

    <footer>
        <p>Derechos de autor © 2024 David Flores</p>
    </footer>

</body>

</html>
