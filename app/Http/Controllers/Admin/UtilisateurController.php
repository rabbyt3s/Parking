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
        return view('admin.users.create');
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
        
        return redirect()->route('users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher les détails d'un utilisateur.
     */
    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Afficher le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user): View
    {
        return view('admin.utilisateurs.edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'est_admin' => 'boolean',
            'est_valide' => 'boolean',
        ]);

        $user->update($request->all());
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make('MotDePasseParDefaut123!')
        ]);
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Mot de passe réinitialisé avec succès');
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        
        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}