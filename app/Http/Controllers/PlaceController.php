<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

final class PlaceController extends Controller
{
    /**
     * Afficher la liste des places.
     */
    public function index(): View
    {
        $places = Place::all();
        
        return view('places.index', compact('places'));
    }

    /**
     * Afficher le formulaire de création d'une place.
     */
    public function create(): View
    {
        return view('places.create');
    }

    /**
     * Enregistrer une nouvelle place.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:places',
            'description' => 'nullable|string',
        ]);

        Place::create($validated);

        return redirect()->route('places.index')
            ->with('success', 'Place créée avec succès.');
    }

    /**
     * Afficher les détails d'une place.
     */
    public function show(Place $place): View
    {
        return view('places.show', compact('place'));
    }

    /**
     * Afficher le formulaire d'édition d'une place.
     */
    public function edit(Place $place): View
    {
        return view('places.edit', compact('place'));
    }

    /**
     * Mettre à jour une place.
     */
    public function update(Request $request, Place $place): RedirectResponse
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:places,numero,' . $place->id,
            'description' => 'nullable|string',
            'est_disponible' => 'boolean',
        ]);

        $place->update($validated);

        return redirect()->route('places.index')
            ->with('success', 'Place mise à jour avec succès.');
    }

    /**
     * Supprimer une place.
     */
    public function destroy(Place $place): RedirectResponse
    {
        $place->delete();

        return redirect()->route('places.index')
            ->with('success', 'Place supprimée avec succès.');
    }
}