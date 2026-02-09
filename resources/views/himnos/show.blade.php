@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        :root {
            --hymn-font-size: 18px;
            --primary: rgb(38, 186, 165);
            --primary-10: rgba(38, 186, 165, 0.1);
            --secondary: rgb(55, 95, 122);
            --secondary-15: rgba(55, 95, 122, 0.15);
            --ink: #1f2a2e;
            --bg: #ffffff;
            --card: #ffffff;
            --muted: #6c757d;
            --border: #e5eaee;
        }

        body.night-mode {
            --ink: #e7eff4;
            --bg: #0f1a22;
            --card: #14232e;
            --muted: #98b1bf;
            --border: #1c2f3a;
            --secondary-15: rgba(55, 95, 122, 0.35);
            --primary-10: rgba(38, 186, 165, 0.18);
        }

        .himno-header {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            position: relative;
            padding: 0 52px;
        }

        .card {
            background: var(--card);
            border-color: var(--border);
        }

        .text-muted {
            color: var(--muted) !important;
        }

        .himno-page {
            color: var(--ink);
        }

        .himno-title {
            flex: 1 1 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .himno-numero {
            width: 72px;
            height: 72px;
            margin: 0 auto 10px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(20px, 3vw, 30px);
            font-weight: 800;
            color: #fff;
            background: radial-gradient(circle at 30% 30%, var(--primary), #1e9986);
            box-shadow: 0 12px 20px rgba(38, 186, 165, 0.35);
        }

        .himno-titulo {
            font-size: clamp(18px, 3.4vw, 52px);
            margin: 6px 0 0;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--ink);
            white-space: nowrap;
            display: inline-block;
            max-width: 100%;
        }

        .himno-autor {
            font-size: 13px;
            letter-spacing: 0.6px;
            color: var(--secondary);
            text-transform: uppercase;
            margin-top: 6px;
        }

        .himno-letra {
            font-size: clamp(16px, var(--hymn-font-size), 26px);
            line-height: 1.25;
        }

        .estrofa {
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
            position: relative;
        }

        .estrofa-texto {
            margin: 0;
            line-height: 0.92;
            white-space: pre-line;
        }

        .coro {
            margin: 10px 0 18px;
            padding: 14px 16px;
            border: 2px solid var(--primary);
            background: linear-gradient(135deg, var(--primary-10), rgba(38, 186, 165, 0.3));
            border-radius: 10px;
            box-shadow: inset 0 0 0 1px rgba(38, 186, 165, 0.2);
        }

        .coro strong {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            margin-bottom: 4px;
            color: var(--secondary);
        }

        .nav-btn {
            min-width: 48px;
        }

        .nav-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            border: 1px solid var(--secondary);
            color: var(--secondary);
            background: var(--card);
            transition: transform 150ms ease, box-shadow 150ms ease, background 150ms ease;
        }

        .nav-icon:hover {
            transform: translateY(-1px);
            background: var(--secondary-15);
            box-shadow: 0 10px 18px rgba(31, 42, 46, 0.12);
        }

        .nav-icon.disabled {
            opacity: 0.4;
            pointer-events: none;
        }

        .btn-outline-secondary,
        .btn-outline-dark {
            border-color: var(--secondary);
            color: var(--secondary);
        }

        .btn-outline-secondary:hover,
        .btn-outline-dark:hover {
            background: var(--secondary-15);
            color: var(--secondary);
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary-10);
            color: var(--primary);
        }

        .nav-left,
        .nav-right {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .nav-left {
            left: 0;
        }

        .nav-right {
            right: 0;
        }

        @media (max-width: 768px) {
            .himno-title {
                text-align: center;
            }
        }
        .night-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid var(--border);
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
            width: 36px;
            height: 20px;
            border-radius: 999px;
            background: var(--secondary-15);
            position: relative;
            transition: background 150ms ease;
        }

        .night-indicator::after {
            content: "";
            width: 16px;
            height: 16px;
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
            transform: translateX(16px);
        }

        .verse-controls {
            position: absolute;
            top: 0;
            right: 0;
            display: inline-flex;
            gap: 6px;
            align-items: center;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 4px 6px;
            box-shadow: 0 8px 16px rgba(31, 42, 46, 0.1);
        }

        .verse-controls .btn {
            width: 28px;
            height: 28px;
            padding: 0;
            line-height: 1;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .favorite-btn {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            border: 1px solid var(--secondary);
            color: var(--secondary);
            background: var(--card);
        }

        .favorite-btn.is-favorite {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-10);
        }

        .bottom-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 16px;
        }

        .bottom-nav .nav-icon {
            width: 46px;
            height: 46px;
        }

        @media (max-width: 768px) {
            .himno-header {
                gap: 16px;
            }

            .nav-btn {
                order: 2;
            }

            .himno-title {
                order: 1;
                text-align: left;
                width: 100%;
            }
        }
    </style>

    <div class="mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2 himno-page">
        <a href="{{ route('himnos.index') }}" class="btn btn-sm btn-outline-secondary" style="border-color: var(--border); color: var(--secondary);">Volver</a>
        <div class="d-flex gap-2 align-items-center">
            <button type="button" class="night-toggle" data-night>
                <span>Oscuro</span>
                <span class="night-indicator" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="card shadow-sm mb-3 himno-page">
        <div class="card-body">
            <div class="himno-header">
                <div class="nav-btn nav-left">
                    @if ($prev)
                        <a class="nav-icon" href="{{ route('himnos.show', $prev) }}" aria-label="Anterior">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <span class="nav-icon disabled" aria-label="Anterior">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    @endif
                </div>
                <div class="himno-title">
                    <div class="himno-numero">
                        {{ $himno->numero_text ?? ($himno->numero ? sprintf('#%03d', $himno->numero) : '-') }}
                    </div>
                    <h1 class="himno-titulo">{{ $himno->titulo }}</h1>
                    @php
                        $autor = null;
                        $autorMusica = null;
                        $tematica = null;
                        if (!empty($himno->informacion)) {
                            $info = $himno->informacion;
                            $values = array_values($info);
                            foreach ($info as $clave => $valor) {
                                if ($autor === null && (stripos((string) $clave, 'anónimo') !== false || stripos((string) $clave, 'anonimo') !== false)) {
                                    $autor = $valor;
                                }
                                if ($autor === null && stripos((string) $clave, 'autor') !== false && strtolower((string) $valor) !== 'música') {
                                    $autor = $valor;
                                }
                            }
                            $autorMusica = $values[1] ?? null;
                            $last = end($values);
                            $tematica = $last !== false ? $last : null;
                        }
                    @endphp
                    @if ($autor)
                        <div class="himno-autor">autor:{{ $autor }}</div>
                    @endif
                </div>
                <div class="nav-btn nav-right">
                    @if ($next)
                        <a class="nav-icon" href="{{ route('himnos.show', $next) }}" aria-label="Siguiente">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @else
                        <span class="nav-icon disabled" aria-label="Siguiente">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-3 himno-page" data-himno-id="{{ $himno->id }}">
        <div class="card-body himno-letra">
            @php
                $estrofas = $himno->estrofas ?? [];
                $coros = $himno->coro ?? [];
            @endphp

            @if (!empty($estrofas))
                @foreach ($estrofas as $estrofa)
                    @php
                        $estrofaTexto = preg_replace("/\n\s*\n+/", "\n", $estrofa);
                    @endphp
                    <div class="estrofa" @if ($loop->first) data-first-stanza @endif>
                        @if ($loop->first)
                            <div class="verse-controls" data-verse-controls>
                                <button type="button" class="btn btn-sm btn-outline-dark" data-font="down" aria-label="Reducir texto">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-dark" data-font="up" aria-label="Aumentar texto">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button type="button" class="favorite-btn" data-favorite aria-label="Favorito">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.8 7.3c0 5.2-8.8 11-8.8 11S3.2 12.5 3.2 7.3c0-2.1 1.7-3.8 3.8-3.8 1.4 0 2.7.8 3.4 2 0.7-1.2 2-2 3.4-2 2.1 0 3.8 1.7 3.8 3.8z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                        <p class="estrofa-texto">{!! nl2br(e($estrofaTexto)) !!}</p>
                    </div>
                    @if ($loop->first && !empty($coros))
                        @foreach ($coros as $coro)
                            @php
                                $coroTexto = preg_replace("/\n\s*\n+/", "\n", $coro);
                            @endphp
                            <div class="coro">
                                <strong>Coro</strong>
                                <p class="estrofa-texto">{!! nl2br(e($coroTexto)) !!}</p>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @elseif ($himno->estrofas_texto)
                @php
                    $textoPlano = preg_replace("/\n\s*\n+/", "\n", $himno->estrofas_texto);
                @endphp
                <p class="estrofa-texto">{!! nl2br(e($textoPlano)) !!}</p>
            @else
                <p class="text-muted">No hay letra disponible.</p>
            @endif
        </div>
    </div>

    <div class="bottom-nav himno-page">
        <div class="nav-btn">
            @if ($prev)
                <a class="nav-icon" href="{{ route('himnos.show', $prev) }}" aria-label="Anterior">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            @else
                <span class="nav-icon disabled" aria-label="Anterior">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            @endif
        </div>
        <div class="nav-btn">
            @if ($next)
                <a class="nav-icon" href="{{ route('himnos.show', $next) }}" aria-label="Siguiente">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            @else
                <span class="nav-icon disabled" aria-label="Siguiente">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            @endif
        </div>
    </div>

    @if ($autorMusica || $tematica || $himno->url)
        <div class="card shadow-sm himno-page">
            <div class="card-body">
                <h2 class="h6">Datos</h2>
                <div class="d-flex flex-column gap-1">
                    @if ($autorMusica)
                        <div><strong>Autor de la musica:</strong> {{ $autorMusica }}</div>
                    @endif
                    @if ($tematica)
                        <div><strong>Tematica:</strong> {{ $tematica }}</div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    (function () {
        var root = document.documentElement;
        var body = document.body;
        var key = 'himnoFontSize';
        var nightKey = 'himnoNightMode';
        var favoriteKey = 'himnoFavorites';
        var min = 14;
        var max = 26;
        var current = parseInt(localStorage.getItem(key) || '18', 10);

        function applySize(size) {
            var safe = Math.max(min, Math.min(max, size));
            root.style.setProperty('--hymn-font-size', safe + 'px');
            localStorage.setItem(key, safe.toString());
        }

        applySize(current);

        if (localStorage.getItem(nightKey) === '1') {
            body.classList.add('night-mode');
        }

        document.querySelectorAll('[data-font]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var dir = btn.getAttribute('data-font');
                current += dir === 'up' ? 2 : -2;
                applySize(current);
            });
        });

        var nightBtn = document.querySelector('[data-night]');
        if (nightBtn) {
            nightBtn.addEventListener('click', function () {
                body.classList.toggle('night-mode');
                localStorage.setItem(nightKey, body.classList.contains('night-mode') ? '1' : '0');
            });
        }

        function loadFavorites() {
            try {
                return JSON.parse(localStorage.getItem(favoriteKey) || '[]');
            } catch (e) {
                return [];
            }
        }

        function saveFavorites(list) {
            localStorage.setItem(favoriteKey, JSON.stringify(list));
        }

        var favoriteBtn = document.querySelector('[data-favorite]');
        var page = document.querySelector('[data-himno-id]');
        if (favoriteBtn && page) {
            var id = page.getAttribute('data-himno-id');
            var list = loadFavorites();
            if (list.includes(id)) {
                favoriteBtn.classList.add('is-favorite');
            }
            favoriteBtn.addEventListener('click', function () {
                var favorites = loadFavorites();
                if (favorites.includes(id)) {
                    favorites = favorites.filter(function (item) { return item !== id; });
                    favoriteBtn.classList.remove('is-favorite');
                } else {
                    favorites.push(id);
                    favoriteBtn.classList.add('is-favorite');
                }
                saveFavorites(favorites);
            });
        }

        function fitTitle() {
            var title = document.querySelector('.himno-titulo');
            if (!title) {
                return;
            }
            var computed = window.getComputedStyle(title);
            var size = parseFloat(computed.fontSize);
            while (title.scrollWidth > title.clientWidth && size > 14) {
                size -= 1;
                title.style.fontSize = size + 'px';
            }
        }

        fitTitle();
        window.addEventListener('resize', fitTitle);
    })();
</script>
@endsection
