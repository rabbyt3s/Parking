<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;

// Routes pour les invités (non connectés)
Route::middleware('guest')->group(function () {
    // Inscription
    Route::get('register', [UtilisateurController::class, 'showRegistrationForm'])
                ->name('register');
    Route::post('register', [UtilisateurController::class, 'register']);

    // Connexion
    Route::get('login', [UtilisateurController::class, 'showLoginForm'])
                ->name('login');
    Route::post('login', [UtilisateurController::class, 'login']);
});

// Routes pour les utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    // Déconnexion
    Route::post('logout', [UtilisateurController::class, 'logout'])
                ->name('logout');
});