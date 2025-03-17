<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class HistoriqueController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::with(['user', 'place'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $users = User::all();
        $places = Place::all();
        
        return view('admin.historique.index', compact('reservations', 'users', 'places'));
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
        
        if ($request->filled('date')) {
            $date = Carbon::parse($request->date);
            $query->whereDate('created_at', $date);
        }
        
        $reservations = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());
        
        $users = User::all();
        $places = Place::all();
        
        return view('admin.historique.index', compact('reservations', 'users', 'places'));
    }
} 