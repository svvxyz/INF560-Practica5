<?php

namespace Database\Seeders;

use App\Models\Sitio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario de prueba
        $usuario = User::factory()->create([
            'name' => 'Bigotes',
            'email' => 'bigotes21@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $sitiosDeEjemplo = [
            [
                'titulo' => 'Laravel',
                'url' => 'https://laravel.com',
                'categoria' => 'Herramientas',
                'descripcion' => 'Framework de PHP para desarrollo backend.',
                'destacado' => false,
            ],
            [
                'titulo' => '365 scores',
                'url' => 'https://www.365scores.com/es',
                'categoria' => 'Deportes',
                'descripcion' => 'Resultados deportivos en vivo.',
                'destacado' => true,
            ],
            [
                'titulo' => 'GitHub',
                'url' => 'https://github.com',
                'categoria' => 'Herramientas',
                'descripcion' => 'Plataforma de control de versiones y colaboración.',
                'destacado' => true,
            ],
            [
                'titulo' => 'Hacker News',
                'url' => 'https://news.ycombinator.com',
                'categoria' => 'Noticias',
                'descripcion' => null,
                'destacado' => false,
            ],
        ];

        foreach ($sitiosDeEjemplo as $datos) {
            Sitio::create($datos + ['user_id' => $usuario->id]);
        }
    }
}
