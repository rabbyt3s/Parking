@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Détails de la place</h1>
                    <a href="{{ route('places.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-400 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour aux places
                    </a>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-md">
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-16 w-16 flex items-center justify-center bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 rounded-full">
                                <span class="text-xl font-bold">{{ $place->numero }}</span>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                                    Place {{ $place->numero }}
                                </h2>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $place->description }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-2">Informations</h3>
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">Statut:</span>
                                        <span class="ml-2">
                                            @if($place->est_disponible)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    Disponible
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    Occupée
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex items-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">Créée le:</span>
                                        <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $place->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">Dernière mise à jour:</span>
                                        <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $place->updated_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-2">Réservation actuelle</h3>
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                                    @if(!$place->est_disponible)
                                        @php
                                            $reservationActive = $place->reservationsActives()->with('user')->first();
                                        @endphp
                                        
                                        @if($reservationActive)
                                            <div class="flex items-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span class="text-gray-700 dark:text-gray-300 font-medium">Réservée par:</span>
                                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $reservationActive->user->name }}</span>
                                            </div>
                                            <div class="flex items-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-gray-700 dark:text-gray-300 font-medium">Date de début:</span>
                                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $reservationActive->date_debut->format('d/m/Y à H:i') }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-gray-700 dark:text-gray-300 font-medium">Date de fin:</span>
                                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $reservationActive->date_fin->format('d/m/Y à H:i') }}</span>
                                            </div>
                                        @else
                                            <div class="text-center py-4">
                                                <p class="text-gray-500 dark:text-gray-400">Aucune réservation active trouvée.</p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center py-4">
                                            <p class="text-gray-500 dark:text-gray-400">Cette place est actuellement disponible.</p>
                                            @if(!Auth::user()->reservations()->where('est_active', true)->exists())
                                                <a href="{{ route('reservations.create') }}" class="mt-2 inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Demander une place
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Historique des réservations -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-2">Historique des réservations</h3>
                            
                            @if($historiqueReservations->isEmpty())
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700 text-center">
                                    <p class="text-gray-500 dark:text-gray-400">Aucun historique de réservation pour cette place.</p>
                                </div>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Utilisateur
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Date de début
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Date de fin
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Statut
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($historiqueReservations as $reservation)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $reservation->user->name }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 dark:text-white">{{ $reservation->date_debut->format('d/m/Y') }}</div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $reservation->date_debut->format('H:i') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 dark:text-white">{{ $reservation->date_fin->format('d/m/Y') }}</div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $reservation->date_fin->format('H:i') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($reservation->est_active)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                                Active
                                                            </span>
                                                        @elseif($reservation->date_fin < now())
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                                Expirée
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                                Annulée
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 