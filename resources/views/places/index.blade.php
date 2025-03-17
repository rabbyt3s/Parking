@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Places de parking</h1>
                
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 dark:bg-green-800 dark:text-green-100" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 dark:bg-red-800 dark:text-red-100" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Résumé des places -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-green-100 dark:bg-green-800 text-green-600 dark:text-green-300 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Places disponibles</h2>
                                <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $placesDisponibles->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-red-100 dark:bg-red-800 text-red-600 dark:text-red-300 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Places occupées</h2>
                                <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $placesOccupees->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Total des places</h2>
                                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $places->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Votre réservation active -->
                @if($reservationActive)
                    <div class="mb-8">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Votre réservation active</h2>
                        <div class="bg-primary-50 dark:bg-primary-900/20 rounded-lg p-6 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-16 flex items-center justify-center bg-primary-100 dark:bg-primary-800 text-primary-600 dark:text-primary-300 rounded-full">
                                    <span class="text-xl font-bold">{{ $reservationActive->place->numero }}</span>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                                        Place n°{{ $reservationActive->place->numero }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ $reservationActive->place->description }}
                                    </p>
                                    <div class="mt-2 flex items-center">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Réservée jusqu'au {{ $reservationActive->date_fin->format('d/m/Y à H:i') }}</span>
                                        <span class="mx-2">•</span>
                                        <a href="{{ route('reservations.show', $reservationActive) }}" class="text-sm text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                            Voir les détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Liste des places -->
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Liste des places</h2>
                    @if(!$reservationActive)
                        <a href="{{ route('reservations.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Demander une place
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($places as $place)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm overflow-hidden border border-gray-200 dark:border-gray-600 hover:shadow-md transition-shadow duration-200">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">{{ $place->numero }}</h3>
                                    @if($place->est_disponible)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Disponible
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Occupée
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $place->description }}</p>
                                <div class="flex justify-end">
                                    <a href="{{ route('places.show', $place) }}" class="text-sm text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                        Voir les détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection