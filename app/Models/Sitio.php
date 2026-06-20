<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Sitio extends Model
{
    use HasFactory;

    public const CATEGORIAS = [
        'Educación',
        'Herramientas',
        'Deportes',
        'Noticias',
        'Entretenimiento',
        'Redes sociales',
        'Otros',
    ];

    protected $table = 'sitios';

    protected $fillable = [
        'user_id',
        'titulo',
        'url',
        'categoria',
        'descripcion',
        'destacado',
    ];

    protected $casts = [
        'destacado' => 'boolean',
    ];

    /**
     * Un sitio favorito pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Búsqueda por título.
     */
    public function scopeBuscarPorTitulo(Builder $query, ?string $termino): Builder
    {
        if (filled($termino)) {
            $query->where('titulo', 'ILIKE', '%' . $termino . '%');
        }

        return $query;
    }

    /**
     * Filtro exacto por categoría.
     */
    public function scopeFiltrarPorCategoria(Builder $query, ?string $categoria): Builder
    {
        if (filled($categoria) && in_array($categoria, self::CATEGORIAS, true)) {
            $query->where('categoria', $categoria);
        }

        return $query;
    }
}
