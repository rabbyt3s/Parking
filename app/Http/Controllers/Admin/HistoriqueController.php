<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoriqueController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::with(['user', 'place'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.historique.index', compact('reservations'));
    }

    public function show(Reservation $reservation): View
    {
        return view('admin.historique.show', compact('reservation'));
    }

    public function search(Request $request): View
    {
        $query = Reservation::with(['user', 'place']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('place_id')) {
            $query->where('place_id', $request->place_id);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $reservations = $query->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.historique.index', compact('reservations'));
    }
} 