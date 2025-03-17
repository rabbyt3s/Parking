@extends('layouts.admin')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
        <h1 class="text-lg font-semibold text-gray-800 dark:text-white">Attribution Manuelle des Places</h1>
    </div>
    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 dark:bg-green-900/20 dark:text-green-300 dark:border-green-600" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 dark:bg-red-900/20 dark:text-red-300 dark:border-red-600" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Formulaire d'attribution -->
        <form action="{{ route('admin.attribution.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden mb-6">
            @csrf
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Attribution Manuelle</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Utilisateur</label>
                        <select name="user_id" id="user_id" required class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                            <option value="">Sélectionner un utilisateur</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="place_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Place</label>
                        <select name="place_id" id="place_id" required class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                            <option value="">Sélectionner une place</option>
                            @foreach($places as $place)
                                <option value="{{ $place->id }}">{{ $place->numero }}</option>
                            @endforeach
                        </select>
                        @error('place_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duree" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Durée (jours)</label>
                        <input type="number" name="duree" id="duree" min="1" max="365" value="30" required class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        @error('duree')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Attribuer la place
                    </button>
                </div>
            </div>
        </form>

        <!-- Liste des réservations actives -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Réservations Actives</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Place
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Date de début
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Date de fin
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach(\App\Models\Reservation::with(['user', 'place'])
                                ->where('date_fin', '>', now())
                                ->orderBy('date_fin')
                                ->get() as $reservation)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $reservation->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $reservation->place->numero }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $reservation->date_debut->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $reservation->date_fin->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('admin.attribution.terminer', $reservation) }}" 
                                              method="POST" 
                                              class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir terminer cette réservation ?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Terminer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 