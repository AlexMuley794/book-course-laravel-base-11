<?php

use App\Http\Controllers\Dashboard\PostController; 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirigir a login si no está autenticado
Route::get('/', function () {
    return Auth::check() ? redirect()->route('post.index') : redirect('/login');
});

// Grupo de rutas protegidas con autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Redirigir a la lista de posts tras autenticarse
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas del blog
    Route::resource('/dashboard/post', PostController::class)->names('post');

    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');  // Mostrar el perfil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Editar el perfil
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Actualizar el perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Eliminar perfil
});

require __DIR__.'/auth.php';
