<?php

namespace App\Http\Requests;

use App\Models\Sitio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSitioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cualquier usuario autenticado puede crear sus propios sitios.
        // La protección de la ruta ya exige autenticación (middleware "auth").
        return true;
    }

    /**
     * Normaliza el checkbox "destacado" antes de validar.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'destacado' => $this->boolean('destacado'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:120'],
            'url' => ['required', 'url', 'max:255'],
            'categoria' => ['required', 'string', Rule::in(Sitio::CATEGORIAS)],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'destacado' => ['boolean'],
        ];
    }

    /**
     * Mensajes de validación en español.
     */
    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 3 caracteres.',
            'titulo.max' => 'El título no puede superar los 120 caracteres.',
            'url.required' => 'La URL es obligatoria.',
            'url.url' => 'Ingresa una URL válida (incluye http:// o https://).',
            'categoria.required' => 'Selecciona una categoría.',
            'categoria.in' => 'La categoría seleccionada no es válida.',
            'descripcion.max' => 'La descripción no puede superar los 500 caracteres.',
        ];
    }
}
