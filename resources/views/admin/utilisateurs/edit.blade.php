@extends('layouts.admin')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Modifier l'Utilisateur</h3>
        <a href="{{ route('admin.utilisateurs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-400 disabled:opacity-25 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la liste
        </a>
    </div>
    <div class="p-6">
        <form action="{{ route('admin.utilisateurs.update', $utilisateur) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $utilisateur->name) }}" 
                       class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 @error('name') border-red-500 dark:border-red-500 @enderror" 
                       required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email', $utilisateur->email) }}" 
                       class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 @error('email') border-red-500 dark:border-red-500 @enderror" 
                       required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <div class="flex items-center mt-2">
                    <input type="checkbox" 
                           id="est_admin" 
                           name="est_admin" 
                           value="1" 
                           {{ old('est_admin', $utilisateur->est_admin) ? 'checked' : '' }}
                           class="rounded border-gray-300 dark:border-gray-700 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-800">
                    <label for="est_admin" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Administrateur</label>
                </div>
            </div>

            <div class="mb-6">
                <div class="flex items-center mt-2">
                    <input type="checkbox" 
                           id="est_valide" 
                           name="est_valide" 
                           value="1" 
                           {{ old('est_valide', $utilisateur->est_valide) ? 'checked' : '' }}
                           class="rounded border-gray-300 dark:border-gray-700 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-800">
                    <label for="est_valide" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Compte validé</label>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.utilisateurs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-400 disabled:opacity-25 transition ease-in-out duration-150">
                    Annuler
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 