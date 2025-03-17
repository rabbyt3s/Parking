<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class ReservationController extends Controller
{
    /**
     * Afficher la liste des réservations de l'utilisateur.
     */
    public function index(): View
    {
        $reservations = Auth::user()->reservations()->with('place')->get();
        
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Afficher le formulaire de création d'une réservation.
     */
    public function create(): View
    {
        $places = Place::where('est_disponible', true)->get();
        
        return view('reservations.create', compact('places'));
    }

    /**
     * Enregistrer une nouvelle réservation.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'place_id' => 'required|exists:places,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $place = Place::findOrFail($validated['place_id']);
        
        // Vérifier si la place est disponible
        if (!$place->est_disponible) {
            return back()->withErrors(['place_id' => 'Cette place n\'est plus disponible.']);
        }
        
        // Créer la réservation
        $reservation = new Reservation([
            'place_id' => $validated['place_id'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'est_active' => true,
        ]);
        
        Auth::user()->reservations()->save($reservation);
        
        // Mettre à jour la disponibilité de la place
        $place->est_disponible = false;
        $place->save();
        
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Afficher les détails d'une réservation.
     */
    public function show(Reservation $reservation): View
    {
        // Vérifier que l'utilisateur est propriétaire de la réservation
        $this->authorize('view', $reservation);
        
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Afficher le formulaire d'édition d'une réservation.
     */
    public function edit(Reservation $reservation): View
    {
        // Vérifier que l'utilisateur est propriétaire de la réservation
        $this->authorize('update', $reservation);
        
        $places = Place::all();
        
        return view('reservations.edit', compact('reservation', 'places'));
    }

    /**
     * Mettre à jour une réservation.
     */
    public function update(Request $request, Reservation $reservation): RedirectResponse
    {
        // Vérifier que l'utilisateur est propriétaire de la réservation
        $this->authorize('update', $reservation);
        
        $validated = $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
        ]);
        
        $reservation->update($validated);
        
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Annuler une réservation.
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        // Vérifier que l'utilisateur est propriétaire de la réservation
        $this->authorize('delete', $reservation);
        
        // Libérer la place
        $place = $reservation->place;
        $place->est_disponible = true;
        $place->save();
        
        // Supprimer la réservation
        $reservation->delete();
        
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée avec succès.');
    }
}