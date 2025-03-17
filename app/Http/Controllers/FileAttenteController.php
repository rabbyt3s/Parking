<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\FileAttente;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class FileAttenteController extends Controller
{
    /**
     * Afficher la file d'attente.
     */
    public function index(): View
    {
        $fileAttente = FileAttente::with('user')
            ->orderBy('position')
            ->get();
        
        $userPosition = Auth::user()->fileAttente;
        
        return view('file-attente.index', compact('fileAttente', 'userPosition'));
    }

    /**
     * Ajouter l'utilisateur à la file d'attente.
     */
    public function store(Request $request): RedirectResponse
    {
        // Vérifier si l'utilisateur est déjà dans la file d'attente
        if (Auth::user()->fileAttente) {
            return back()->withErrors(['message' => 'Vous êtes déjà dans la file d\'attente.']);
        }
        
        // Déterminer la dernière position
        $lastPosition = FileAttente::max('position') ?? 0;
        
        // Créer une nouvelle entrée dans la file d'attente
        $fileAttente = new FileAttente([
            'position' => $lastPosition + 1,
            'date_demande' => now(),
            'user_id' => Auth::id(),
        ]);
        
        Auth::user()->fileAttente()->save($fileAttente);
        
        return redirect()->route('file-attente.index')
            ->with('success', 'Vous avez été ajouté à la file d\'attente.');
    }

    /**
     * Retirer l'utilisateur de la file d'attente.
     */
    public function destroy(): RedirectResponse
    {
        $fileAttente = Auth::user()->fileAttente;
        
        if (!$fileAttente) {
            return back()->withErrors(['message' => 'Vous n\'êtes pas dans la file d\'attente.']);
        }
        
        $position = $fileAttente->position;
        
        // Supprimer l'entrée de la file d'attente
        $fileAttente->delete();
        
        // Réorganiser les positions
        DB::transaction(function () use ($position) {
            FileAttente::where('position', '>', $position)
                ->update(['position' => DB::raw('position - 1')]);
        });
        
        return redirect()->route('file-attente.index')
            ->with('success', 'Vous avez été retiré de la file d\'attente.');
    }
}