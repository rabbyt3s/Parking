<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

final class UtilisateurController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index(): View
    {
        $users = User::all();
        
        return view('admin.utilisateurs.index', compact('users'));
    }

    /**
     * Afficher le formulaire de création d'un utilisateur.
     */
    public function create(): View
    {
        return view('admin.utilisateurs.create');
    }

    /**
     * Enregistrer un nouvel utilisateur.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'est_admin' => 'boolean',
            'est_valide' => 'boolean',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);
        
        $user = User::create($validated);
        
        // Journalisation de la création d'utilisateur
        Log::info("L'administrateur " . auth()->id() . " a créé un nouvel utilisateur " . $user->id . " (" . $user->email . ")");
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher les détails d'un utilisateur.
     */
    public function show(User $utilisateur): View
    {
        // Récupérer les réservations récentes de l'utilisateur
        $reservations = \App\Models\Reservation::where('user_id', $utilisateur->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        return view('admin.utilisateurs.show', compact('utilisateur', 'reservations'));
    }

    /**
     * Afficher le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $utilisateur): View
    {
        return view('admin.utilisateurs.edit', compact('utilisateur'));
    }

    /**
     * Mettre à jour un utilisateur.
     */
    public function update(Request $request, User $utilisateur): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $utilisateur->id,
            'est_admin' => 'boolean',
            'est_valide' => 'boolean',
        ]);

        // Vérifier si le statut d'admin a changé pour le journaliser
        $oldIsAdmin = $utilisateur->est_admin;
        $newIsAdmin = $request->has('est_admin');

        $utilisateur->update($request->all());
        
        // Journalisation des modifications sensibles
        if ($oldIsAdmin !== $newIsAdmin) {
            $action = $newIsAdmin ? "a promu administrateur" : "a révoqué les droits d'administrateur de";
            Log::warning("L'administrateur " . auth()->id() . " $action l'utilisateur " . $utilisateur->id);
        }
        
        Log::info("L'administrateur " . auth()->id() . " a modifié l'utilisateur " . $utilisateur->id);
        
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function resetPassword(User $utilisateur)
    {
        // Génération d'un mot de passe aléatoire sécurisé
        $password = bin2hex(random_bytes(8)); // 16 caractères hexadécimaux
        
        // Sauvegarde du mot de passe et marquage pour forcer le changement à la prochaine connexion
        $utilisateur->update([
            'password' => Hash::make($password),
            'force_password_change' => true
        ]);
        
        // Journalisation de l'action
        \Log::info('Mot de passe réinitialisé pour l\'utilisateur ' . $utilisateur->id . ' par l\'administrateur ' . auth()->id());
        
        // Redirection avec message de succès incluant le nouveau mot de passe à communiquer à l'utilisateur
        return redirect()->route('admin.utilisateurs.show', $utilisateur)
            ->with('success', 'Mot de passe réinitialisé avec succès. Nouveau mot de passe temporaire : ' . $password);
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $utilisateur): RedirectResponse
    {
        // Journalisation avant suppression
        Log::warning("L'administrateur " . auth()->id() . " a supprimé l'utilisateur " . $utilisateur->id . " (" . $utilisateur->email . ")");
        
        $utilisateur->delete();
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}