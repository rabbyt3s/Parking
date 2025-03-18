<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FileAttenteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UtilisateurController;
use App\Http\Controllers\Admin\HistoriqueController;
use App\Http\Controllers\Admin\AttributionController;
use App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use App\Http\Middleware\CheckAdmin;

// Page d'accueil
Route::get('/', function () {
    return view('home');
});

// Routes pour l'authentification
Route::middleware(['web', 'throttle:auth'])->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

// Routes pour la réinitialisation de mot de passe
Route::middleware(['web', 'throttle:password'])->group(function () {
    Route::get('/password/reset', [App\Http\Controllers\Auth\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Auth\PasswordResetController::class, 'reset'])->name('password.update');
});

// Routes pour les places
Route::middleware(['auth'])->group(function () {
    Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
    Route::get('/places/{place}', [PlaceController::class, 'show'])->name('places.show');
    
    // Routes pour la modification du mot de passe
    Route::get('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangeForm'])
        ->name('password.change.form');
    Route::post('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])
        ->name('password.change');
    
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

        // Route PUT explicite pour utilisateurs
        Route::put('/utilisateurs/{utilisateur}', [UtilisateurController::class, 'update'])
            ->middleware(CheckAdmin::class)
            ->name('admin.utilisateurs.update.explicit');

        // Routes pour la gestion des utilisateurs
        Route::resource('utilisateurs', UtilisateurController::class)
            ->middleware(CheckAdmin::class)
            ->names([
                'index' => 'admin.utilisateurs.index',
                'create' => 'admin.utilisateurs.create',
                'store' => 'admin.utilisateurs.store',
                'show' => 'admin.utilisateurs.show',
                'edit' => 'admin.utilisateurs.edit',
                'update' => 'admin.utilisateurs.update',
                'destroy' => 'admin.utilisateurs.destroy',
            ]);

        // Routes pour la gestion des places
        Route::resource('places', AdminPlaceController::class)
            ->middleware(CheckAdmin::class)
            ->names([
                'index' => 'admin.places.index',
                'create' => 'admin.places.create',
                'store' => 'admin.places.store',
                'show' => 'admin.places.show',
                'edit' => 'admin.places.edit',
                'update' => 'admin.places.update',
                'destroy' => 'admin.places.destroy',
            ]);

        // Route pour la réinitialisation du mot de passe
        Route::patch('/utilisateurs/{user}/reset-password', [UtilisateurController::class, 'resetPassword'])
            ->middleware(CheckAdmin::class)
            ->name('admin.utilisateurs.reset-password');

        // Routes pour l'historique des attributions
        Route::get('/historique', [HistoriqueController::class, 'index'])
            ->middleware(CheckAdmin::class)
            ->name('admin.historique.index');
        Route::get('/historique/search', [HistoriqueController::class, 'search'])
            ->middleware(CheckAdmin::class)
            ->name('admin.historique.search');
        Route::get('/historique/{reservation}', [HistoriqueController::class, 'show'])
            ->middleware(CheckAdmin::class)
            ->name('admin.historique.show');

        // Routes pour l'attribution manuelle
        Route::get('/attribution', [AttributionController::class, 'index'])
            ->middleware(CheckAdmin::class)
            ->name('admin.attribution.index');
        Route::post('/attribution', [AttributionController::class, 'store'])
            ->middleware(CheckAdmin::class)
            ->name('admin.attribution.store');
        Route::patch('/attribution/{reservation}/terminer', [AttributionController::class, 'terminer'])
            ->middleware(CheckAdmin::class)
            ->name('admin.attribution.terminer');

        // Routes pour la gestion de la file d'attente
        Route::get('/file-attente', [FileAttenteController::class, 'index'])
            ->middleware(CheckAdmin::class)
            ->name('admin.file-attente.index');
        Route::post('/file-attente', [FileAttenteController::class, 'store'])
            ->middleware(CheckAdmin::class)
            ->name('admin.file-attente.store');
        Route::delete('/file-attente/{fileAttente}', [FileAttenteController::class, 'destroy'])
            ->middleware(CheckAdmin::class)
            ->name('admin.file-attente.destroy');
    });

    // Documentation
    Route::get('/documentation', [App\Http\Controllers\DocumentationController::class, 'index'])
        ->name('documentation');

    // Routes pour le changement de mot de passe forcé
    Route::get('/force-password-change', [App\Http\Controllers\Auth\ForcePasswordChangeController::class, 'showChangeForm'])
        ->name('password.force.change');
    Route::post('/force-password-change', [App\Http\Controllers\Auth\ForcePasswordChangeController::class, 'update'])
        ->name('password.force.update');
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