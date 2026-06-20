<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSitioRequest;
use App\Http\Requests\UpdateSitioRequest;
use App\Models\Sitio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SitioController extends Controller
{
    public function index(Request $request): View
    {
        $sitios = auth()->user()->sitios()
            ->buscarPorTitulo($request->query('buscar'))
            ->filtrarPorCategoria($request->query('categoria'))
            ->orderByDesc('destacado')
            ->orderByDesc('created_at')
            ->paginate(9)
            ->withQueryString();

        return view('sitios.index', [
            'sitios' => $sitios,
            'categorias' => Sitio::CATEGORIAS,
            'buscar' => $request->query('buscar', ''),
            'categoriaSeleccionada' => $request->query('categoria', ''),
        ]);
    }

    public function create(): View
    {
        return view('sitios.create', [
            'categorias' => Sitio::CATEGORIAS,
        ]);
    }

    public function store(StoreSitioRequest $request): RedirectResponse
    {
        auth()->user()->sitios()->create($request->validated());

        return redirect()
            ->route('sitios.index')
            ->with('success', 'El sitio favorito se registró correctamente.');
    }

    public function edit(int $id): View
    {
        $sitio = auth()->user()->sitios()->findOrFail($id);

        return view('sitios.edit', [
            'sitio' => $sitio,
            'categorias' => Sitio::CATEGORIAS,
        ]);
    }

    public function update(UpdateSitioRequest $request, int $id): RedirectResponse
    {
        $sitio = auth()->user()->sitios()->findOrFail($id);

        $sitio->update($request->validated());

        return redirect()
            ->route('sitios.index')
            ->with('success', 'El sitio favorito se actualizó correctamente.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $sitio = auth()->user()->sitios()->findOrFail($id);
        $sitio->delete();

        return redirect()
            ->route('sitios.index')
            ->with('success', 'El sitio favorito se eliminó correctamente.');
    }
}
