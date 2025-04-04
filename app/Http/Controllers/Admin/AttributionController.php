<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class AttributionController extends Controller
{
    public function index(): View
    {
        $places = Place::where('est_disponible', true)->orderBy('numero')->get();
        $users = User::all();
        
        return view('admin.attribution.index', compact('places', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'place_id' => 'required|exists:places,id',
            'duree' => 'required|integer|min:1|max:365', // Durée en jours
        ]);

        $user = User::findOrFail($request->user_id);
        $place = Place::findOrFail($request->place_id);

        // Vérifier si l'utilisateur a déjà une réservation active
        if ($user->reservations()->where('date_fin', '>', now())->exists()) {
            return back()->with('error', 'Cet utilisateur a déjà une réservation active.');
        }

        // Vérifier si la place est disponible
        if (!$place->est_disponible) {
            return back()->with('error', 'Cette place n\'est pas disponible.');
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'user_id' => $user->id,
            'place_id' => $place->id,
            'date_debut' => now(),
            'date_fin' => now()->addDays((int)$request->duree),
        ]);

        // Mettre à jour le statut de la place
        $place->update(['est_disponible' => false]);

        return redirect()->route('admin.attribution.index')
            ->with('success', 'La place a été attribuée avec succès.');
    }

    public function terminer(Reservation $reservation): RedirectResponse
    {
        // Vérifier si la réservation est active
        if ($reservation->date_fin <= now()) {
            return back()->with('error', 'Cette réservation est déjà terminée.');
        }

        // Mettre à jour la date de fin de la réservation
        $reservation->update([
            'date_fin' => now(),
        ]);

        // Marquer la place comme disponible à nouveau
        $reservation->place->update(['est_disponible' => true]);

        return back()->with('success', 'La réservation a été terminée avec succès.');
    }
} 