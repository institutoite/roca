<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roca y Coronado</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fraunces:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600&display=swap" rel="stylesheet" />

    <style>
        :root {
            --primary: rgb(38, 186, 165);
            --primary-10: rgba(38, 186, 165, 0.12);
            --secondary: rgb(55, 95, 122);
            --secondary-15: rgba(55, 95, 122, 0.15);
            --ink: #1f2a2e;
            --muted: #6c7b86;
            --card: #ffffff;
            --line: #e5eaee;
            --bg: #f4f7f8;
            --shadow: 0 24px 48px rgba(16, 26, 32, 0.14);
        }

        body.night-mode {
            --ink: #e7eff4;
            --muted: #98b1bf;
            --card: #14232e;
            --line: #1c2f3a;
            --bg: #0f1b23;
            --shadow: 0 24px 48px rgba(6, 10, 12, 0.55);
            --secondary-15: rgba(55, 95, 122, 0.35);
            --primary-10: rgba(38, 186, 165, 0.18);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Space Grotesk", "Segoe UI", Tahoma, sans-serif;
            color: var(--ink);
            background: radial-gradient(1200px 600px at 12% 0%, rgba(38, 186, 165, 0.18) 0%, var(--bg) 45%, var(--bg) 100%);
            min-height: 100vh;
        }

        body.night-mode {
            background: radial-gradient(1200px 600px at 12% 0%, rgba(38, 186, 165, 0.2) 0%, var(--bg) 45%, var(--bg) 100%);
        }

        .wrap {
            position: relative;
            overflow: hidden;
        }

        .wrap::before,
        .wrap::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(0);
            z-index: 0;
        }

        .wrap::before {
            background: radial-gradient(circle at 30% 30%, rgba(38, 186, 165, 0.35), transparent 70%);
            top: -120px;
            right: -80px;
        }

        .wrap::after {
            background: radial-gradient(circle at 30% 30%, rgba(55, 95, 122, 0.4), transparent 70%);
            bottom: -160px;
            left: -120px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px 64px;
            position: relative;
            z-index: 1;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 36px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-badge {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #3dd6c2 100%);
            box-shadow: var(--shadow);
        }

        .brand h1 {
            font-family: "Fraunces", serif;
            font-size: 28px;
            margin: 0;
            letter-spacing: 0.3px;
        }

        .brand span {
            color: var(--muted);
            font-size: 13px;
            display: block;
        }

        .auth {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 999px;
            border: 1px solid var(--line);
            font-weight: 600;
            font-size: 14px;
            transition: transform 150ms ease, box-shadow 150ms ease;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: var(--shadow);
        }

        .btn-ghost {
            color: #fff;
            background: var(--secondary);
            border-color: var(--secondary);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        body.night-mode .btn-ghost {
            color: #fff;
            background: var(--secondary);
            border-color: var(--secondary);
        }

        body.night-mode .btn-primary {
            color: #fff;
            background: var(--primary);
            border-color: var(--primary);
        }

        .night-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid var(--line);
            color: var(--secondary);
            background: var(--card);
            font-size: 12px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .night-toggle:hover {
            background: var(--secondary-15);
        }

        .night-indicator {
            width: 32px;
            height: 18px;
            border-radius: 999px;
            background: var(--secondary-15);
            position: relative;
            transition: background 150ms ease;
        }

        .night-indicator::after {
            content: "";
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--card);
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform 150ms ease;
        }

        body.night-mode .night-indicator {
            background: var(--primary-10);
        }

        body.night-mode .night-indicator::after {
            transform: translateX(14px);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 32px;
            align-items: center;
            margin-bottom: 40px;
        }

        .hero h2 {
            font-family: "Fraunces", serif;
            font-size: 42px;
            line-height: 1.1;
            margin: 0 0 12px;
        }

        .hero p {
            color: var(--muted);
            font-size: 16px;
            margin: 0 0 24px;
        }

        .hero-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 22px;
            box-shadow: var(--shadow);
        }

        .hero-card h3 {
            margin: 0 0 8px;
            font-size: 18px;
        }

        .hero-card p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(140deg, rgba(255, 255, 255, 0.95) 0%, rgba(245, 250, 251, 0.9) 100%);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 22px;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 10px 26px rgba(16, 26, 32, 0.1);
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 20px;
            border: 1px solid transparent;
            background: linear-gradient(120deg, rgba(38, 186, 165, 0.2), rgba(55, 95, 122, 0.18)) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            opacity: 0;
            transition: opacity 180ms ease;
        }

        .card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0.8;
        }

        .card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 18px 32px rgba(16, 26, 32, 0.16);
            border-color: transparent;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card .icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            margin-bottom: 14px;
            color: var(--secondary);
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(16, 26, 32, 0.12);
        }

        .card h4 {
            margin: 0 0 6px;
            font-size: 18px;
        }

        .card p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .icon-amber { background: rgba(38, 186, 165, 0.18); }
        .icon-teal { background: rgba(55, 95, 122, 0.16); }
        .icon-coral { background: rgba(38, 186, 165, 0.12); }
        .icon-olive { background: rgba(55, 95, 122, 0.12); }
        .icon-lilac { background: rgba(38, 186, 165, 0.1); }
        .icon-sand { background: rgba(55, 95, 122, 0.1); }

        body.night-mode .card,
        body.night-mode .hero-card {
            border-color: var(--line);
        }

        body.night-mode .card {
            background: linear-gradient(140deg, rgba(20, 35, 46, 0.95) 0%, rgba(18, 28, 36, 0.9) 100%);
            box-shadow: 0 14px 30px rgba(6, 10, 12, 0.55);
        }

        body.night-mode .card::after {
            opacity: 0.9;
        }

        footer {
            margin-top: 48px;
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .hero h2 {
                font-size: 34px;
            }
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="container">
        <header>
            <div class="brand">
                <div class="brand-badge"></div>
                <div>
                    <h1>Roca y Coronado</h1>
                    <span>Centro de recursos y ministerios</span>
                </div>
            </div>

            @if (Route::has('login'))
                <div class="auth">
                    <button type="button" class="night-toggle" data-night>
                        <span>Oscuro</span>
                        <span class="night-indicator" aria-hidden="true"></span>
                    </button>
                    @auth
                        <a class="btn btn-primary" href="{{ url('/home') }}">Panel</a>
                    @else
                        <a class="btn btn-ghost" href="{{ route('login') }}">Ingresar</a>
                        @if (Route::has('register'))
                            <a class="btn btn-primary" href="{{ route('register') }}">Registrarme</a>
                        @endif
                    @endauth
                </div>
            @endif
        </header>

        <section class="hero">
            <div>
                <h2>Una casa para la palabra, la alabanza y la comunión.</h2>
                <p>Accede a himnos, prédicas, actividades y recursos para fortalecer la fe y la vida en el Serñor.</p>
                <a class="btn btn-primary" href="{{ route('himnos.index') }}">Explorar himnos</a>
                <a class="btn btn-ghost" href="{{ route('actividades') }}">Ver actividades</a>
            </div>
            <div class="hero-card">
                <h3>Itinerarios y recursos</h3>
                <p>Explora contenidos organizados por temas, letras y ministerios. Todo en un solo lugar.</p>
            </div>
        </section>

        <section class="grid">
            <a class="card" href="{{ route('himnos.index') }}">
                <div class="icon icon-amber">
                    <span>H</span>
                </div>
                <h4>Himnos</h4>
                <p>Letra por estrofas, coro y datos del himno.</p>
            </a>

            <a class="card" href="{{ route('ministerios.index') }}">
                <div class="icon icon-teal">
                    <span>P</span>
                </div>
                <h4>Predicas</h4>
                <p>Escucha y comparte mensajes del ministerio.</p>
            </a>

            <a class="card" href="{{ route('actividades') }}">
                <div class="icon icon-coral">
                    <span>A</span>
                </div>
                <h4>Actividades</h4>
                <p>Calendario de reuniones y eventos especiales.</p>
            </a>

            <a class="card" href="{{ route('coros.index') }}">
                <div class="icon icon-olive">
                    <span>C</span>
                </div>
                <h4>Coros</h4>
                <p>Seccion para coros y canticos breves.</p>
            </a>

            <a class="card" href="{{ route('estudios.index') }}">
                <div class="icon icon-lilac">
                    <span>E</span>
                </div>
                <h4>Estudios</h4>
                <p>Material de estudio y guias tematicas.</p>
            </a>
            <a class="card" href="{{ route('iglesias.index') }}">
                <div class="icon icon-lilac">
                    <span>I</span>
                </div>
                <h4>Iglesias</h4>
                <p>Información sobre iglesias y comunidades.</p>
            </a>

            <a class="card" href="{{ url('/home') }}">
                <div class="icon icon-sand">
                    <span>L</span>
                </div>
                <h4>Panel</h4>
                <p>Administracion y contenido interno.</p>
            </a>
        </section>

        <footer>
            Roca y Coronado · Comunidad, alabanza y servicio.
        </footer>
    </div>
</div>

<script>
    (function () {
        var nightKey = 'himnoNightMode';
        var nightBtn = document.querySelector('[data-night]');

        if (localStorage.getItem(nightKey) === '1') {
            document.body.classList.add('night-mode');
        }

        if (nightBtn) {
            nightBtn.addEventListener('click', function () {
                document.body.classList.toggle('night-mode');
                localStorage.setItem(nightKey, document.body.classList.contains('night-mode') ? '1' : '0');
            });
        }
    })();
</script>
<script>
    (function () {
        if (!('serviceWorker' in navigator)) {
            return;
        }

        window.addEventListener('load', function () {
            navigator.serviceWorker.register('/sw.js').catch(function () {
                // noop
            });
        });
    })();
</script>
</body>
</html>
