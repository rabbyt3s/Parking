<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Place;
use App\Models\Reservation;
use App\Models\FileAttente;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord d'administration.
     */
    public function index(): View
    {
        $stats = [
            'total_users' => User::where('est_admin', false)->count(),
            'total_places' => Place::count(),
            'places_disponibles' => Place::where('disponible', true)->count(),
            'reservations_actives' => Reservation::where('date_fin', '>', now())->count(),
            'file_attente' => FileAttente::count(),
        ];

        $dernieres_reservations = Reservation::with(['user', 'place'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $derniers_inscrits = User::where('est_admin', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'dernieres_reservations', 'derniers_inscrits'));
    }
}
