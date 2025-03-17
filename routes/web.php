<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FileAttenteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\CheckAdmin;

// Page d'accueil
Route::get('/', function () {
    return view('home');
});

// Routes pour l'authentification
Route::middleware(['auth'])->group(function () {
    // Routes pour les places
    Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
    Route::get('/places/{place}', [PlaceController::class, 'show'])->name('places.show');
    
    // Routes pour les réservations
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::get('/reservations/history', [ReservationController::class, 'history'])->name('reservations.history');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    
    // Routes pour la file d'attente
    Route::get('/file-attente', [FileAttenteController::class, 'index'])->name('file-attente.index');
    Route::post('/file-attente', [FileAttenteController::class, 'store'])->name('file-attente.store');
    Route::delete('/file-attente/{fileAttente}', [FileAttenteController::class, 'destroy'])->name('file-attente.destroy');
    
    // Routes pour l'administration
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware(CheckAdmin::class)
            ->name('admin.dashboard');
    });
});

// Ajout d'une route de test pour vérifier si l'utilisateur est admin
Route::get('/check-admin', function () {
    if (auth()->check()) {
        return 'Utilisateur connecté avec ID: ' . auth()->id() . 
               '<br>Est admin: ' . (auth()->user()->est_admin ? 'Oui' : 'Non') .
               '<br>Valeur de est_admin: ' . auth()->user()->est_admin;
    }
    return 'Utilisateur non connecté';
});

// Routes pour l'authentification
require __DIR__.'/auth.php';