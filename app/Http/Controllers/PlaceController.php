<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class PlaceController extends Controller
{
    /**
     * Affiche la liste des places disponibles.
     */
    public function index(): View
    {
        $places = Place::where('est_disponible', true)->get();
        
        return view('places.index', compact('places'));
    }

    /**
     * Affiche les détails d'une place spécifique.
     */
    public function show(Place $place): View
    {
        return view('places.show', compact('place'));
    }
}