<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

final class PlaceController extends Controller
{
    /**
     * Affiche la liste des places disponibles.
     */
    public function index(): View
    {
        // Récupérer toutes les places
        $places = Place::all();
        
        // Récupérer les places disponibles
        $placesDisponibles = Place::where('est_disponible', true)->get();
        
        // Récupérer les places occupées
        $placesOccupees = Place::where('est_disponible', false)
            ->with(['reservations' => function($query) {
                $query->where('est_active', true);
            }])
            ->get();
        
        // Récupérer la réservation active de l'utilisateur connecté
        $reservationActive = Auth::user()->reservations()
            ->where('est_active', true)
            ->with('place')
            ->first();
        
        return view('places.index', compact('places', 'placesDisponibles', 'placesOccupees', 'reservationActive'));
    }

    /**
     * Affiche les détails d'une place spécifique.
     */
    public function show(Place $place): View
    {
        // Récupérer l'historique des réservations pour cette place
        $historiqueReservations = $place->reservations()
            ->with('user')
            ->orderBy('date_debut', 'desc')
            ->take(5)
            ->get();
        
        return view('places.show', compact('place', 'historiqueReservations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:places,numero',
            'description' => 'nullable|string|max:255',
            'est_disponible' => 'boolean',
        ]);

        // Si est_disponible n'est pas dans la requête, on le met à true par défaut
        $validated['est_disponible'] = $request->has('est_disponible');

        Place::create($validated);

        return redirect()
            ->route('admin.places.index')
            ->with('success', 'Place créée avec succès.');
    }
}