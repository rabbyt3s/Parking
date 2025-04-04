@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">
                    Créer une nouvelle place
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.places.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="py-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <form method="POST" action="{{ route('admin.places.store') }}" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @csrf
                    
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Numéro de place -->
                            <div>
                                <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Numéro de place
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="numero" id="numero" 
                                        class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md @error('numero') border-red-500 @enderror" 
                                        value="{{ old('numero') }}" 
                                        required>
                                    @error('numero')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Description
                                </label>
                                <div class="mt-1">
                                    <textarea name="description" id="description" rows="3" 
                                        class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Une description détaillée de l'emplacement de la place (optionnel)
                                </p>
                            </div>

                            <!-- Disponibilité -->
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" name="est_disponible" id="est_disponible" 
                                        class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 dark:border-gray-600 rounded"
                                        value="1" 
                                        {{ old('est_disponible', true) ? 'checked' : '' }}>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="est_disponible" class="font-medium text-gray-700 dark:text-gray-300">Place disponible</label>
                                    <p class="text-gray-500 dark:text-gray-400">La place sera marquée comme disponible pour les réservations</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                        <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Créer la place
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection