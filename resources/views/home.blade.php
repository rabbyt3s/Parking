@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Bienvenue sur l'application de gestion de parking</h1>
                
                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Fonctionnalités disponibles :</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Consultation des places disponibles</li>
                        <li>Réservation d'une place de parking</li>
                        <li>Inscription sur la file d'attente</li>
                        @if (auth()->check() && auth()->user()->est_admin)
                        <li>Administration du système</li>
                        @endif
                    </ul>
                </div>
                
                <div class="mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Places disponibles</h3>
                            <p class="text-gray-600 mb-4">Consultez les places de parking disponibles et leurs caractéristiques.</p>
                            <a href="{{ route('places.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Voir les places
                            </a>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Réservations</h3>
                            <p class="text-gray-600 mb-4">Gérez vos réservations de places de parking.</p>
                            <a href="{{ route('reservations.index') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                Mes réservations
                            </a>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">File d'attente</h3>
                            <p class="text-gray-600 mb-4">Inscrivez-vous sur la file d'attente pour obtenir une place.</p>
                            <a href="{{ route('file-attente.index') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                File d'attente
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection