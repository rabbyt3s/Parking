@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">File d'attente</h1>
                
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 dark:bg-green-800 dark:text-green-100" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('info'))
                    <div class="mb-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 dark:bg-blue-800 dark:text-blue-100" role="alert">
                        <p>{{ session('info') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 dark:bg-red-800 dark:text-red-100" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Statut de l'utilisateur dans la file d'attente -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-8">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Votre statut</h2>
                    
                    @if($userPosition)
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-300 rounded-full">
                                <span class="text-xl font-bold">{{ $userPosition->position }}</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-md font-medium text-gray-800 dark:text-white">Vous êtes en position {{ $userPosition->position }} dans la file d'attente</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Demande effectuée le {{ $userPosition->date_demande->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <form action="{{ route('file-attente.destroy', $userPosition) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Êtes-vous sûr de vouloir quitter la file d\'attente ?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Quitter la file d'attente
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Vous n'êtes pas dans la file d'attente</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">Rejoignez la file d'attente pour obtenir une place de parking dès qu'elle sera disponible.</p>
                            
                            @if(Auth::user()->reservations()->where('est_active', true)->exists())
                                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 dark:bg-yellow-800 dark:text-yellow-100 mb-4" role="alert">
                                    <p>Vous avez déjà une réservation active. Vous ne pouvez pas rejoindre la file d'attente.</p>
                                </div>
                            @else
                                <form action="{{ route('file-attente.store') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Rejoindre la file d'attente
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
                
                <!-- Liste des personnes dans la file d'attente -->
                <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Liste d'attente</h2>
                
                @if($fileAttente->isEmpty())
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">File d'attente vide</h3>
                        <p class="text-gray-500 dark:text-gray-400">Il n'y a actuellement personne dans la file d'attente.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Position
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Utilisateur
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Date de demande
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Temps d'attente
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($fileAttente as $attente)
                                    <tr class="{{ $attente->user_id === Auth::id() ? 'bg-primary-50 dark:bg-primary-900/20' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 flex items-center justify-center {{ $attente->position <= 3 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }} rounded-full">
                                                    <span class="text-sm font-medium">{{ $attente->position }}</span>
                                                </div>
                                                @if($attente->position === 1)
                                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        Prochain
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $attente->user_id === Auth::id() ? 'Vous' : $attente->user->name }}
                                            </div>
                                            @if($attente->user_id === Auth::id())
                                                <div class="text-xs text-primary-600 dark:text-primary-400">
                                                    C'est vous
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $attente->date_demande->format('d/m/Y') }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $attente->date_demande->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $attente->date_demande->diffForHumans() }}
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
@endsection