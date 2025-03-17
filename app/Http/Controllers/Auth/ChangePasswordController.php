<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    /**
     * Affiche le formulaire de modification du mot de passe.
     */
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    /**
     * Change le mot de passe de l'utilisateur.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('Le mot de passe actuel est incorrect.');
                }
            }],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'Votre mot de passe a été modifié avec succès.');
    }
} 