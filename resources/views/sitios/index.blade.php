<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Mis sitios favoritos
            </h2>
            <a href="{{ route('sitios.create') }}">
                <x-primary-button>+ Nuevo sitio</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md dark:bg-green-900 dark:border-green-700 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Búsqueda y filtros --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
                <form method="GET" action="{{ route('sitios.index') }}" class="flex flex-col sm:flex-row gap-3 sm:items-end">
                    <div class="flex-1">
                        <x-input-label for="buscar" value="Buscar por título" />
                        <x-text-input
                            id="buscar"
                            name="buscar"
                            type="text"
                            class="mt-1 block w-full"
                            value="{{ $buscar }}"
                            placeholder="Ej: Laravel, GitHub..."
                        />
                    </div>

                    <div class="sm:w-56">
                        <x-input-label for="categoria" value="Categoría" />
                        <select
                            id="categoria"
                            name="categoria"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                        >
                            <option value="">Todas las categorías</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria }}" @selected($categoriaSeleccionada === $categoria)>
                                    {{ $categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <x-primary-button type="submit">Filtrar</x-primary-button>
                        @if ($buscar || $categoriaSeleccionada)
                            <a href="{{ route('sitios.index') }}"
                               class="inline-flex items-center px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Listado --}}
            @if ($sitios->isEmpty())
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-center text-gray-500 dark:text-gray-400">
                    No tienes sitios favoritos registrados todavía.
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($sitios as $sitio)
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-100">
                                        {{ $sitio->titulo }}
                                    </h3>
                                    @if ($sitio->destacado)
                                        <span class="shrink-0 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            ★ Destacado
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ $sitio->url }}" target="_blank" rel="noopener noreferrer"
                                   class="text-sm text-indigo-600 dark:text-indigo-400 break-all hover:underline">
                                    {{ $sitio->url }}
                                </a>

                                <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                    {{ $sitio->categoria }}
                                </span>

                                @if ($sitio->descripcion)
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $sitio->descripcion }}
                                    </p>
                                @endif
                            </div>

                            <div class="mt-4 flex justify-end gap-3">
                                <a href="{{ route('sitios.edit', $sitio) }}"
                                   class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                                    Editar
                                </a>

                                <form method="POST" action="{{ route('sitios.destroy', $sitio) }}"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este sitio favorito?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div>
                    {{ $sitios->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
