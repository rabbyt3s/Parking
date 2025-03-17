@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Demande de réservation</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Faites une demande pour obtenir une place de parking. Une place libre vous sera attribuée aléatoirement.
                    </p>
                </div>

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 dark:bg-red-800 dark:text-red-100" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 dark:bg-red-800 dark:text-red-100">
                        <div class="font-medium">Veuillez corriger les erreurs suivantes :</div>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reservations.store') }}" method="POST" class="mt-6 space-y-6">
                    @csrf

                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="immediate" name="immediate" type="checkbox" checked disabled class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="immediate" class="font-medium text-gray-700 dark:text-gray-300">Réservation immédiate</label>
                                <p class="text-gray-500 dark:text-gray-400">Les réservations sont toujours immédiates. Une place vous sera attribuée aléatoirement parmi les places disponibles.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Durée de la réservation (en jours)</label>
                        <select id="duration" name="duration" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">1 jour</option>
                            <option value="2">2 jours</option>
                            <option value="3">3 jours</option>
                            <option value="7">1 semaine</option>
                            <option value="14">2 semaines</option>
                            <option value="30">1 mois</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-400 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Demander une place
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 