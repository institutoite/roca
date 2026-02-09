@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        :root {
            --primary: rgb(38, 186, 165);
            --primary-10: rgba(38, 186, 165, 0.1);
            --secondary: rgb(55, 95, 122);
            --secondary-15: rgba(165,165,165, 0.01);
            --ink: #1f2a2e;
            --card: #ffffff;
            --muted: rgba(118, 119, 119, 0.7);
            --border: #8c8e91;
            --table-font-size: 14px;
            --search-font-size: 14px;
        }

        body.night-mode {
            --ink: #e7eff4;
            --card: #14232e;
            --muted: #cccecf;
            --border: #1c2f3a;
            --secondary-15: rgba(55, 95, 122, 0.35);
            --primary-10: rgba(38, 186, 165, 0.18);
        }

        body.night-mode .himnos-title,
        body.night-mode .fw-semibold,
        body.night-mode tbody td:first-child {
            color: #e7eff4 !important;
        }

        .himnos-page {
            color: var(--ink);
        }

        .himnos-title {
            font-weight: 800;
            text-transform: uppercase;
            color: var(--ink) !important;
        }

        .badge-soft {
            background: var(--secondary-15);
            color: var(--secondary);
            border: 1px solid var(--border);
            font-weight: 600;
        }

        .card {
            background: var(--card);
            border-color: var(--border);
        }

        .search-wrap {
            position: relative;
            width: 95%;
        }

        .search-row {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input {
            border-color: var(--border);
            padding-right: 36px;
            background: var(--card);
            color: var(--ink);
            font-size: var(--search-font-size);
        }

        .search-input::placeholder {
            color: var(--muted);
        }

        .clear-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            width: 26px;
            height: 26px;
            border-radius: 999px;
            background: var(--secondary-15);
            color: var(--secondary);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .clear-btn.show {
            display: inline-flex;
        }

        .form-select {
            border-color: var(--border);
        }

        .table thead th {
            text-transform: uppercase;
            letter-spacing: 0.6px;
            font-size: 12px;
            color: var(--secondary);
            border-bottom-color: var(--border);
        }

        .table {
            color: var(--ink);
            font-size: var(--table-font-size);
        }

        .table > :not(caption) > * > * {
            background-color: transparent;
        }

        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: var(--secondary-15);
        }

        .table tbody td {
            border-color: var(--border);
        }

        .subtematica {
            color: var(--muted);
            font-size: 12px;
        }

        .match-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid var(--border);
            color: var(--secondary);
            background: var(--secondary-15);
        }

        .match-badge.primary {
            color: var(--primary);
            border-color: var(--primary);
            background: var(--primary-10);
        }

        .eye-link {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            border: 1px solid var(--border);
            background: var(--card);
            transition: background 150ms ease, transform 150ms ease;
        }

        .eye-link:hover {
            background: var(--secondary-15);
            transform: translateY(-1px);
        }

        .pagination {
            --bs-pagination-color: var(--secondary);
            --bs-pagination-border-color: var(--border);
            --bs-pagination-hover-color: var(--secondary);
            --bs-pagination-hover-bg: var(--secondary-15);
            --bs-pagination-active-bg: var(--primary);
            --bs-pagination-active-border-color: var(--primary);
        }

        .pagination .page-link {
            border-radius: 999px;
            margin: 0 4px;
            font-size: 12px;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .top-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .ghost-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid var(--border);
            color: var(--secondary);
            text-decoration: none;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            background: transparent;
        }

        .ghost-link:hover {
            background: var(--secondary-15);
        }

        .ghost-link[disabled] {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .offline-status {
            font-size: 12px;
            color: var(--muted);
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

        .form-check-input {
            border-color: var(--border);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            color: var(--ink);
        }

        .size-btn {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            border: 1px solid var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            background: var(--card);
        }

        .size-btn:hover {
            background: var(--secondary-15);
        }
    </style>

    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-2 himnos-page">
        <div>
            <h1 class="h3 mb-1 himnos-title">Himnos</h1>
            <div class="text-muted">Explora y filtra por letra o titulo.</div>
        </div>
        <div class="top-actions">
            <a class="ghost-link" href="{{ url('/') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 10.5L12 4l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-9.5z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Inicio
            </a>
            <button type="button" class="ghost-link" data-offline>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    <path d="M8 9l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M5 20h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                Guardar sin internet
            </button>
            <button type="button" class="ghost-link" data-offline-clear>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 6l12 12M18 6l-12 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                Borrar cache
            </button>
            <span class="offline-status" id="offline-status"></span>
            <button type="button" class="night-toggle" data-night>
                <span>Oscuro</span>
                <span class="night-indicator" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="card shadow-sm mb-3 himnos-page">
        <div class="card-body">
            <div class="row g-2 align-items-end">
                <div class="col-12">
                    <label class="form-label">Buscar</label>
                    <div class="search-row">
                        <div class="search-wrap">
                            <input type="text" id="search-input" class="form-control search-input" placeholder="Titulo o numero" value="{{ $search }}">
                            <button type="button" class="clear-btn" id="clear-input" aria-label="Limpiar">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 6l12 12M18 6l-12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="size-btn" data-size="down" aria-label="Reducir texto">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </button>
                            <button type="button" class="size-btn" data-size="up" aria-label="Aumentar texto">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" value="1" id="filter-favorites">
                        <label class="form-check-label" for="filter-favorites">
                            Mostrar solo favoritos
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm himnos-page">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0" id="himnos-table">
                    <thead>
                        <tr>
                            <th style="width: 110px;">#</th>
                            <th>Titulo</th>
                            <th style="width: 120px;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="himnos-body">
                        @forelse ($himnos as $himno)
                            @php
                                $subtematica = null;
                                if (!empty($himno->informacion)) {
                                    $values = array_values($himno->informacion);
                                    $last = end($values);
                                    $subtematica = $last !== false ? $last : null;
                                }
                                $numeroTexto = $himno->numero_text ?? ($himno->numero ? sprintf('#%03d', $himno->numero) : '-');
                                $matchLabel = null;
                                $matchClass = null;
                                if (!empty($search)) {
                                    $term = function_exists('mb_strtolower') ? mb_strtolower($search) : strtolower($search);
                                    $titulo = function_exists('mb_strtolower') ? mb_strtolower($himno->titulo) : strtolower($himno->titulo);
                                    $numeroLower = function_exists('mb_strtolower') ? mb_strtolower($numeroTexto) : strtolower($numeroTexto);
                                    $coroText = '';
                                    if (!empty($himno->coro)) {
                                        $coroText = is_array($himno->coro) ? implode(' ', $himno->coro) : (string) $himno->coro;
                                    }
                                    $coroText = function_exists('mb_strtolower') ? mb_strtolower($coroText) : strtolower($coroText);
                                    $estrofaText = '';
                                    if (!empty($himno->estrofas_texto)) {
                                        $estrofaText = (string) $himno->estrofas_texto;
                                    } elseif (!empty($himno->estrofas) && is_array($himno->estrofas)) {
                                        $estrofaText = implode(' ', $himno->estrofas);
                                    }
                                    $estrofaText = function_exists('mb_strtolower') ? mb_strtolower($estrofaText) : strtolower($estrofaText);

                                    if ($term !== '' && strpos($titulo, $term) !== false) {
                                        $matchLabel = 'Titulo';
                                        $matchClass = 'primary';
                                    } elseif ($term !== '' && strpos($numeroLower, $term) !== false) {
                                        $matchLabel = 'Numero';
                                    } elseif ($term !== '' && strpos($coroText, $term) !== false) {
                                        $matchLabel = 'Coro';
                                    } elseif ($term !== '' && strpos($estrofaText, $term) !== false) {
                                        $matchLabel = 'Estrofa';
                                    }
                                }
                            @endphp
                            <tr data-himno-id="{{ $himno->id }}">
                                <td>{{ $numeroTexto }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $himno->titulo }}</div>
                                    @if ($subtematica)
                                        <div class="subtematica">{{ $subtematica }}</div>
                                    @endif
                                    @if ($matchLabel)
                                        <div class="mt-1">
                                            <span class="match-badge {{ $matchClass ?? '' }}">{{ $matchLabel }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <a class="eye-link" href="{{ route('himnos.show', $himno) }}" aria-label="Ver">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.5 12s3.75-6.5 10.5-6.5S22.5 12 22.5 12s-3.75 6.5-10.5 6.5S1.5 12 1.5 12z" stroke="currentColor" stroke-width="1.8" />
                                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay himnos cargados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div id="pagination-wrap">
            {{ $himnos->links() }}
        </div>
    </div>
</div>

<script>
    (function () {
        var favoriteKey = 'himnoFavorites';
        var checkbox = document.getElementById('filter-favorites');
        var searchInput = document.getElementById('search-input');
        var clearInput = document.getElementById('clear-input');
        var nightKey = 'himnoNightMode';
        var nightBtn = document.querySelector('[data-night]');
        var offlineBtn = document.querySelector('[data-offline]');
        var offlineClearBtn = document.querySelector('[data-offline-clear]');
        var offlineStatus = document.getElementById('offline-status');
        var bodyEl = document.getElementById('himnos-body');
        var paginationWrap = document.getElementById('pagination-wrap');
        var typingTimer;
        var sizeButtons = document.querySelectorAll('[data-size]');
        var sizeKey = 'himnoListFontSize';
        var minSize = 12;
        var maxSize = 18;
        var currentSize = parseInt(localStorage.getItem(sizeKey) || '14', 10);
        var offlineListUrl = @json(route('himnos.offline-list'));
        var offlineAssetsUrl = @json(route('himnos.offline-assets'));
        var offlineRequestId = null;

        function loadFavorites() {
            try {
                return JSON.parse(localStorage.getItem(favoriteKey) || '[]');
            } catch (e) {
                return [];
            }
        }

        function applyFilter() {
            var term = (searchInput && searchInput.value ? searchInput.value : '').trim();
            if (clearInput) {
                clearInput.classList.toggle('show', term.length > 0);
            }

            var url = new URL(window.location.href);
            if (term) {
                url.searchParams.set('q', term);
            } else {
                url.searchParams.delete('q');
            }

            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function (res) { return res.text(); })
                .then(function (html) {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, 'text/html');
                    var newBody = doc.getElementById('himnos-body');
                    var newPagination = doc.getElementById('pagination-wrap');
                    if (newBody && bodyEl) {
                        bodyEl.innerHTML = newBody.innerHTML;
                    }
                    if (newPagination && paginationWrap) {
                        paginationWrap.innerHTML = newPagination.innerHTML;
                    }
                    applyFavorites();
                });
        }

        function applyFavorites() {
            if (!checkbox || !checkbox.checked) {
                return;
            }
            var favorites = loadFavorites();
            document.querySelectorAll('tr[data-himno-id]').forEach(function (row) {
                var id = row.getAttribute('data-himno-id');
                row.style.display = favorites.includes(id) ? '' : 'none';
            });
        }

        if (checkbox) {
            checkbox.addEventListener('change', applyFavorites);
        }
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(applyFilter, 250);
            });
        }
        if (clearInput && searchInput) {
            clearInput.addEventListener('click', function () {
                searchInput.value = '';
                applyFilter();
                searchInput.focus();
            });
        }

        if (localStorage.getItem(nightKey) === '1') {
            document.body.classList.add('night-mode');
        }

        if (nightBtn) {
            nightBtn.addEventListener('click', function () {
                document.body.classList.toggle('night-mode');
                localStorage.setItem(nightKey, document.body.classList.contains('night-mode') ? '1' : '0');
            });
        }

        function setOfflineStatus(message) {
            if (!offlineStatus) {
                return;
            }
            offlineStatus.textContent = message;
        }

        function cacheOffline() {
            if (!offlineBtn) {
                return;
            }
            if (!('serviceWorker' in navigator)) {
                setOfflineStatus('No disponible en este navegador.');
                return;
            }

            offlineBtn.setAttribute('disabled', 'disabled');
            setOfflineStatus('Guardando himnos...');
            offlineRequestId = 'offline-' + Date.now().toString(36);

            Promise.all([
                fetch(offlineListUrl).then(function (res) { return res.json(); }),
                fetch(offlineAssetsUrl).then(function (res) { return res.json(); })
            ])
                .then(function (results) {
                    var hymnUrls = results[0] && Array.isArray(results[0].urls) ? results[0].urls : [];
                    var assetUrls = results[1] && Array.isArray(results[1].urls) ? results[1].urls : [];
                    var merged = hymnUrls.concat(assetUrls);
                    var unique = Array.from(new Set(merged));

                    return navigator.serviceWorker.ready.then(function (reg) {
                        if (reg.active) {
                            reg.active.postMessage({ type: 'CACHE_URLS', urls: unique, requestId: offlineRequestId });
                        }
                    });
                })
                .then(function () {
                    setOfflineStatus('Preparando cache...');
                })
                .catch(function () {
                    setOfflineStatus('No se pudo guardar.');
                })
                .finally(function () {
                    offlineBtn.removeAttribute('disabled');
                });
        }

        function clearOffline() {
            if (!offlineClearBtn) {
                return;
            }
            if (!('serviceWorker' in navigator)) {
                setOfflineStatus('No disponible en este navegador.');
                return;
            }

            offlineClearBtn.setAttribute('disabled', 'disabled');
            setOfflineStatus('Borrando cache...');

            navigator.serviceWorker.ready
                .then(function (reg) {
                    if (reg.active) {
                        reg.active.postMessage({ type: 'CLEAR_CACHE' });
                    }
                })
                .then(function () {
                    setOfflineStatus('Cache borrada.');
                })
                .catch(function () {
                    setOfflineStatus('No se pudo borrar la cache.');
                })
                .finally(function () {
                    offlineClearBtn.removeAttribute('disabled');
                });
        }

        if (offlineBtn) {
            offlineBtn.addEventListener('click', cacheOffline);
        }

        if (offlineClearBtn) {
            offlineClearBtn.addEventListener('click', clearOffline);
        }

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.addEventListener('message', function (event) {
                if (!event.data || !event.data.type) {
                    return;
                }
                if (event.data.requestId && offlineRequestId && event.data.requestId !== offlineRequestId) {
                    return;
                }
                if (event.data.type === 'CACHE_PROGRESS') {
                    setOfflineStatus('Guardando ' + event.data.current + ' de ' + event.data.total + '...');
                }
                if (event.data.type === 'CACHE_DONE') {
                    setOfflineStatus('Himnos listos sin internet.');
                }
            });
        }

        function applySize(size) {
            var safe = Math.max(minSize, Math.min(maxSize, size));
            document.documentElement.style.setProperty('--table-font-size', safe + 'px');
            document.documentElement.style.setProperty('--search-font-size', safe + 'px');
            localStorage.setItem(sizeKey, safe.toString());
            currentSize = safe;
        }

        applySize(currentSize);

        sizeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var dir = btn.getAttribute('data-size');
                applySize(currentSize + (dir === 'up' ? 1 : -1));
            });
        });
        applyFavorites();
    })();
</script>
@endsection
