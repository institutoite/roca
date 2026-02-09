<?php

namespace App\Http\Controllers;

use App\Models\Himno;
use Illuminate\Http\Request;

class HimnoController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('q', ''));
        $letra = strtoupper(trim((string) $request->get('letra', '')));

        $query = Himno::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                    ->orWhere('numero_text', 'like', "%{$search}%")
                    ->orWhere('numero', $search)
                    ->orWhere('estrofas_texto', 'like', "%{$search}%")
                    ->orWhere('estrofas_html', 'like', "%{$search}%")
                    ->orWhere('coro', 'like', "%{$search}%")
                    ->orWhere('estrofas', 'like', "%{$search}%");
            });
        }

        if ($letra !== '') {
            $query->where('letra', $letra);
        }

        $himnos = $query
            ->orderBy('numero')
            ->orderBy('titulo')
            ->paginate(50)
            ->appends($request->only(['q', 'letra']));

        $letras = Himno::query()
            ->select('letra')
            ->whereNotNull('letra')
            ->where('letra', '!=', '')
            ->distinct()
            ->orderBy('letra')
            ->pluck('letra');

        return view('himnos.index', compact('himnos', 'letras', 'search', 'letra'));
    }

    public function show(Himno $himno)
    {
        $prev = null;
        $next = null;

        if (!empty($himno->numero)) {
            $prev = Himno::query()
                ->whereNotNull('numero')
                ->where('numero', '<', $himno->numero)
                ->orderBy('numero', 'desc')
                ->first();

            $next = Himno::query()
                ->whereNotNull('numero')
                ->where('numero', '>', $himno->numero)
                ->orderBy('numero')
                ->first();
        }

        if (!$prev) {
            $prev = Himno::query()
                ->where('id', '<', $himno->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        if (!$next) {
            $next = Himno::query()
                ->where('id', '>', $himno->id)
                ->orderBy('id')
                ->first();
        }

        return view('himnos.show', compact('himno', 'prev', 'next'));
    }

    public function offlineList()
    {
        $urls = Himno::query()
            ->select('id')
            ->orderBy('id')
            ->get()
            ->map(function (Himno $himno) {
                return route('himnos.show', $himno);
            })
            ->values();

        return response()->json(['urls' => $urls]);
    }

    public function offlineAssets()
    {
        $urls = [];
        $manifestPath = public_path('build/manifest.json');

        if (is_file($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            if (is_array($manifest)) {
                foreach ($manifest as $entry) {
                    if (!empty($entry['file'])) {
                        $urls[] = '/build/' . ltrim($entry['file'], '/');
                    }
                    if (!empty($entry['css']) && is_array($entry['css'])) {
                        foreach ($entry['css'] as $cssFile) {
                            $urls[] = '/build/' . ltrim($cssFile, '/');
                        }
                    }
                    if (!empty($entry['assets']) && is_array($entry['assets'])) {
                        foreach ($entry['assets'] as $asset) {
                            $urls[] = '/build/' . ltrim($asset, '/');
                        }
                    }
                }
            }
        }

        $urls = array_values(array_unique($urls));

        return response()->json(['urls' => $urls]);
    }
}
