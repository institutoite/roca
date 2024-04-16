<nav class="navbar navbar-expand-lg navbar-dark fondoTurqueza">
    <div class="container">
        <a class="navbar-brand" href="#">Shalom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link textoLinks" href="{{ route('quienessomos') }}">Quiénes Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link textoLinks" href="{{ route('actividades') }}">Actividades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link textoLinks" href="/">Inicio</a>
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
