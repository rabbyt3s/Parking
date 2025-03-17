<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PlaceController extends Controller
{
    public function index(): View
    {
        $places = Place::orderBy('numero')->get();
        return view('admin.places.index', compact('places'));
    }

    public function create(): View
    {
        return view('admin.places.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'numero' => 'required|string|unique:places,numero',
            'description' => 'nullable|string|max:255',
        ]);

        Place::create($request->all());

        return redirect()->route('admin.places.index')
            ->with('success', 'La place a été créée avec succès.');
    }

    public function edit(Place $place): View
    {
        return view('admin.places.edit', compact('place'));
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
        
        return view('admin.places.show', compact('place', 'historiqueReservations'));
    }

    public function update(Request $request, Place $place): RedirectResponse
    {
        $request->validate([
            'numero' => 'required|string|unique:places,numero,' . $place->id,
            'description' => 'nullable|string|max:255',
            'est_disponible' => 'boolean',
        ]);

        $place->update($request->all());

        return redirect()->route('admin.places.index')
            ->with('success', 'La place a été mise à jour avec succès.');
    }

    public function destroy(Place $place): RedirectResponse
    {
        $place->delete();

        return redirect()->route('admin.places.index')
            ->with('success', 'La place a été supprimée avec succès.');
    }
}
