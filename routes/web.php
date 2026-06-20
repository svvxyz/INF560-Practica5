<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    // Redirige el dashboard hacia el listado de favoritos.
    Route::get('/dashboard', function () {
        return redirect()->route('sitios.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD de sitios favoritos.
    Route::resource('sitios', SitioController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
