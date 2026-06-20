@php
    $sitio = $sitio ?? null;
@endphp

<div class="space-y-6">
    <div>
        <x-input-label for="titulo" value="Título" />
        <x-text-input
            id="titulo"
            name="titulo"
            type="text"
            class="mt-1 block w-full"
            :value="old('titulo', $sitio->titulo ?? '')"
            required
            autofocus
        />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="url" value="URL" />
        <x-text-input
            id="url"
            name="url"
            type="text"
            placeholder="https://ejemplo.com"
            class="mt-1 block w-full"
            :value="old('url', $sitio->url ?? '')"
            required
        />
        <x-input-error :messages="$errors->get('url')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="categoria" value="Categoría" />
        <select
            id="categoria"
            name="categoria"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
        >
            <option value="" disabled {{ old('categoria', $sitio->categoria ?? '') === '' ? 'selected' : '' }}>
                Selecciona una categoría
            </option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria }}" @selected(old('categoria', $sitio->categoria ?? '') === $categoria)>
                    {{ $categoria }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="descripcion" value="Descripción (opcional)" />
        <textarea
            id="descripcion"
            name="descripcion"
            rows="3"
            maxlength="500"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
        >{{ old('descripcion', $sitio->descripcion ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>

    <div class="flex items-center">
        <input
            id="destacado"
            name="destacado"
            type="checkbox"
            value="1"
            @checked(old('destacado', $sitio->destacado ?? false))
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900"
        />
        <label for="destacado" class="ms-2 text-sm text-gray-600 dark:text-gray-400">
            Marcar como destacado
        </label>
    </div>
</div>
