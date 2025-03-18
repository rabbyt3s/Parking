<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ForcePasswordChangeController extends Controller
{
    /**
     * Affiche le formulaire pour changer le mot de passe obligatoirement.
     */
    public function showChangeForm()
    {
        return view('auth.force-password-change');
    }

    /**
     * Met à jour le mot de passe de l'utilisateur et désactive le flag de changement obligatoire.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Valider les données avec des règles de sécurité strictes
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Le mot de passe actuel est incorrect.');
                }
            }],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(10)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'different:current_password'
            ],
        ], [
            'password.different' => 'Le nouveau mot de passe doit être différent du mot de passe actuel.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Mettre à jour le mot de passe et désactiver le flag de changement obligatoire
        $user->update([
            'password' => Hash::make($request->password),
            'force_password_change' => false,
        ]);

        // Journaliser le changement de mot de passe
        Log::info("L'utilisateur {$user->id} a changé son mot de passe après réinitialisation forcée");

        return redirect()->route('home')
            ->with('success', 'Votre mot de passe a été changé avec succès.');
    }
}
