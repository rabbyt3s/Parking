<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

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
        
        User::create($validated);
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher les détails d'un utilisateur.
     */
    public function show(User $utilisateur): View
    {
        return view('admin.utilisateurs.show', compact('utilisateur'));
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

        $utilisateur->update($request->all());
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function resetPassword(User $utilisateur)
    {
        $utilisateur->update([
            'password' => Hash::make('MotDePasseParDefaut123!')
        ]);
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Mot de passe réinitialisé avec succès');
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $utilisateur): RedirectResponse
    {
        $utilisateur->delete();
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}