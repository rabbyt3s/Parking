@extends('layouts.admin')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
        <h1 class="text-lg font-semibold text-gray-800 dark:text-white">Modifier une place</h1>
        <a href="{{ route('admin.places.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-400 disabled:opacity-25 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la liste
        </a>
    </div>
    <div class="p-6">
        <form action="{{ route('admin.places.update', $place) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Numéro de place</label>
                <input type="text" name="numero" id="numero" value="{{ old('numero', $place->numero) }}" class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50" required>
                @error('numero')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">{{ old('description', $place->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="est_disponible" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Disponibilité</label>
                <select name="est_disponible" id="est_disponible" class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    <option value="1" {{ $place->est_disponible ? 'selected' : '' }}>Disponible</option>
                    <option value="0" {{ !$place->est_disponible ? 'selected' : '' }}>Non disponible</option>
                </select>
                @error('est_disponible')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.places.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-400 disabled:opacity-25 transition ease-in-out duration-150">
                    Annuler
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 