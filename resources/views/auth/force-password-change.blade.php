@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Changement de mot de passe requis</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Votre mot de passe a été réinitialisé par un administrateur. Pour des raisons de sécurité, vous devez définir un nouveau mot de passe avant de continuer.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                <div class="font-medium text-red-600 dark:text-red-400">
                    {{ __('Oups! Une erreur est survenue.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.force.update') }}" id="passwordForm">
            @csrf

            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe temporaire actuel</label>
                <input id="current_password" type="password" name="current_password" required class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50" autocomplete="current-password">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nouveau mot de passe</label>
                <input id="password" type="password" name="password" required class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50" autocomplete="new-password">
                <div class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                    <p>Le mot de passe doit contenir au minimum :</p>
                    <ul class="list-disc list-inside ml-2 mt-1">
                        <li>10 caractères</li>
                        <li>Une lettre majuscule et une lettre minuscule</li>
                        <li>Un chiffre</li>
                        <li>Un caractère spécial</li>
                    </ul>
                </div>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le nouveau mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50" autocomplete="new-password">
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-700 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Changer mon mot de passe
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('passwordForm');
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password_confirmation');
        
        form.addEventListener('submit', function(event) {
            // Vérification de la correspondance des mots de passe
            if (password.value !== passwordConfirm.value) {
                event.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
                return false;
            }
            
            // Vérification des critères de complexité
            const passwordValue = password.value;
            const hasUpperCase = /[A-Z]/.test(passwordValue);
            const hasLowerCase = /[a-z]/.test(passwordValue);
            const hasNumbers = /\d/.test(passwordValue);
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
            const isLongEnough = passwordValue.length >= 10;
            
            if (!hasUpperCase || !hasLowerCase || !hasNumbers || !hasSpecialChar || !isLongEnough) {
                event.preventDefault();
                alert('Le mot de passe ne respecte pas les critères de sécurité requis.');
                return false;
            }
        });
    });
</script>
@endpush 