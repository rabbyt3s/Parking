<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Reservation;
use App\Models\FileAttente;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        // Vérifier si l'utilisateur a déjà une réservation active
        $hasActiveReservation = Auth::user()->reservations()
            ->where('est_active', true)
            ->exists();
            
        // Vérifier si l'utilisateur est déjà dans la file d'attente
        $isInQueue = Auth::user()->fileAttente()->exists();
        
        return view('reservations.create', compact('hasActiveReservation', 'isInQueue'));
    }

    /**
     * Enregistrer une nouvelle réservation.
     */
    public function store(Request $request): RedirectResponse
    {
        // Valider la durée de la réservation
        $validated = $request->validate([
            'duration' => 'required|integer|min:1|max:30',
        ]);
        
        // Vérifier si l'utilisateur a déjà une réservation active
        if (Auth::user()->reservations()->where('est_active', true)->exists()) {
            return back()->withErrors(['message' => 'Vous avez déjà une réservation active.']);
        }
        
        // Vérifier si l'utilisateur est déjà dans la file d'attente
        if (Auth::user()->fileAttente()->exists()) {
            return back()->withErrors(['message' => 'Vous êtes déjà dans la file d\'attente.']);
        }
        
        // Chercher une place disponible aléatoirement
        $place = Place::where('est_disponible', true)->inRandomOrder()->first();
        
        // Si aucune place n'est disponible, ajouter l'utilisateur à la file d'attente
        if (!$place) {
            // Déterminer la dernière position
            $lastPosition = FileAttente::max('position') ?? 0;
            
            // Créer une nouvelle entrée dans la file d'attente
            $fileAttente = new FileAttente([
                'position' => $lastPosition + 1,
                'date_demande' => now(),
            ]);
            
            Auth::user()->fileAttente()->save($fileAttente);
            
            return redirect()->route('file-attente.index')
                ->with('info', 'Aucune place n\'est disponible actuellement. Vous avez été ajouté à la file d\'attente.');
        }
        
        // Calculer les dates de début et de fin
        $dateDebut = now();
        $dateFin = $dateDebut->copy()->addDays($validated['duration']);
        
        // Créer la réservation dans une transaction
        DB::transaction(function () use ($place, $dateDebut, $dateFin) {
            // Créer la réservation
            $reservation = new Reservation([
                'place_id' => $place->id,
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
                'est_active' => true,
            ]);
            
            Auth::user()->reservations()->save($reservation);
            
            // Mettre à jour la disponibilité de la place
            $place->est_disponible = false;
            $place->save();
        });
        
        return redirect()->route('reservations.index')
            ->with('success', 'La place n°' . $place->numero . ' vous a été attribuée avec succès jusqu\'au ' . $dateFin->format('d/m/Y H:i') . '.');
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
        
        DB::transaction(function () use ($reservation) {
            // Libérer la place
            $place = $reservation->place;
            $place->est_disponible = true;
            $place->save();
            
            // Marquer la réservation comme inactive au lieu de la supprimer
            $reservation->est_active = false;
            $reservation->save();
            
            // Vérifier s'il y a des personnes dans la file d'attente
            $firstInQueue = FileAttente::orderBy('position')->first();
            
            if ($firstInQueue) {
                // Attribuer la place à la première personne dans la file d'attente
                $user = $firstInQueue->user;
                
                // Créer une nouvelle réservation pour cet utilisateur
                $newReservation = new Reservation([
                    'place_id' => $place->id,
                    'date_debut' => now(),
                    'date_fin' => now()->addDays(7), // Durée par défaut de 7 jours
                    'est_active' => true,
                ]);
                
                $user->reservations()->save($newReservation);
                
                // Mettre à jour la disponibilité de la place
                $place->est_disponible = false;
                $place->save();
                
                // Supprimer l'entrée de la file d'attente
                $position = $firstInQueue->position;
                $firstInQueue->delete();
                
                // Réorganiser les positions
                FileAttente::where('position', '>', $position)
                    ->update(['position' => DB::raw('position - 1')]);
            }
        });
        
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée avec succès.');
    }
    
    /**
     * Afficher l'historique des réservations de l'utilisateur.
     */
    public function history(): View
    {
        $reservations = Auth::user()->reservations()
            ->with('place')
            ->orderBy('date_debut', 'desc')
            ->get();
        
        return view('reservations.history', compact('reservations'));
    }
}