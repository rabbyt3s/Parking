@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête de bienvenue -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Bienvenue sur l'application de gestion de parking</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">Gérez facilement vos places de stationnement, réservations et file d'attente</p>
        </div>
        
        <!-- Statistiques rapides -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="card bg-gradient-to-br from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 border-primary-200 dark:border-primary-800/50">
                <div class="p-6 flex items-center">
                    <div class="rounded-full bg-primary-500/10 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-primary-600 dark:text-primary-400">Places disponibles</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ rand(5, 20) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card bg-gradient-to-br from-accent-50 to-accent-100 dark:from-accent-900/20 dark:to-accent-800/20 border-accent-200 dark:border-accent-800/50">
                <div class="p-6 flex items-center">
                    <div class="rounded-full bg-accent-500/10 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent-600 dark:text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-accent-600 dark:text-accent-400">Réservations actives</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ rand(10, 30) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900/50 dark:to-gray-800/50 border-gray-200 dark:border-gray-700">
                <div class="p-6 flex items-center">
                    <div class="rounded-full bg-gray-500/10 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">En file d'attente</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ rand(0, 15) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Fonctionnalités principales -->
        <div class="mb-10 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 overflow-hidden">
            <div class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/50 py-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Fonctionnalités disponibles</h2>
            </div>
            
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                <li class="py-4 px-6 flex items-center">
                    <div class="flex-shrink-0 h-6 w-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 dark:text-green-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="ml-3 text-base text-gray-700 dark:text-gray-300">Consultation des places disponibles avec filtres avancés</p>
                </li>
                <li class="py-4 px-6 flex items-center">
                    <div class="flex-shrink-0 h-6 w-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 dark:text-green-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="ml-3 text-base text-gray-700 dark:text-gray-300">Réservation d'une place de parking avec confirmation instantanée</p>
                </li>
                <li class="py-4 px-6 flex items-center">
                    <div class="flex-shrink-0 h-6 w-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 dark:text-green-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="ml-3 text-base text-gray-700 dark:text-gray-300">Inscription sur la file d'attente avec notifications</p>
                </li>
                @if (auth()->check() && auth()->user()->est_admin)
                <li class="py-4 px-6 flex items-center">
                    <div class="flex-shrink-0 h-6 w-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 dark:text-green-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="ml-3 text-base text-gray-700 dark:text-gray-300">Administration complète du système et rapports détaillés</p>
                </li>
                @endif
            </ul>
        </div>
        
        <!-- Cartes de services -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card hover:shadow-lg transition-shadow duration-300">
                <div class="h-2 bg-primary-500 rounded-t-lg"></div>
                <div class="p-6">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">Places disponibles</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-center mb-6">Consultez les places de parking disponibles et leurs caractéristiques en temps réel.</p>
                    <div class="flex justify-center">
                        <a href="{{ route('places.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 hover:bg-primary-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-primary-700 focus:ring ring-primary-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Voir les places
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card hover:shadow-lg transition-shadow duration-300">
                <div class="h-2 bg-accent-500 rounded-t-lg"></div>
                <div class="p-6">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-accent-500 text-white mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">Réservations</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-center mb-6">Gérez vos réservations de places de parking et consultez votre historique.</p>
                    <div class="flex justify-center">
                        <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-accent-500 hover:bg-accent-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-accent-700 focus:ring ring-accent-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Mes réservations
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card hover:shadow-lg transition-shadow duration-300">
                <div class="h-2 bg-gray-500 rounded-t-lg"></div>
                <div class="p-6">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-500 text-white mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">File d'attente</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-center mb-6">Inscrivez-vous sur la file d'attente pour obtenir une place dès qu'elle sera disponible.</p>
                    <div class="flex justify-center">
                        <a href="{{ route('file-attente.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-700 focus:ring ring-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            File d'attente
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        @if (auth()->check() && auth()->user()->est_admin)
        <!-- Section Admin -->
        <div class="mt-10">
            <div class="card bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 border-purple-200 dark:border-purple-800/50">
                <div class="p-6 text-center">
                    <div class="flex flex-col items-center mb-4">
                        <div class="h-12 w-12 rounded-md bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Administration du système</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-4 max-w-lg mx-auto">En tant qu'administrateur, vous avez accès à des fonctionnalités avancées pour gérer l'ensemble du système de parking.</p>
                    <div class="flex justify-center">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                            Accéder au tableau de bord
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection