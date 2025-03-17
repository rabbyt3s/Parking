@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Documentation</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <nav class="space-y-1 sticky top-6">
                            <a href="#intro" class="block py-2 px-3 text-primary-600 dark:text-primary-400 font-medium bg-primary-50 dark:bg-gray-700 rounded-md">Introduction</a>
                            <a href="#access" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400 rounded-md">Accès et authentification</a>
                            <a href="#places" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400 rounded-md">Gestion des places</a>
                            <a href="#reservations" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400 rounded-md">Réservations</a>
                            <a href="#queue" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400 rounded-md">File d'attente</a>
                            <a href="#account" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400 rounded-md">Gestion du compte</a>
                            <a href="#admin" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400 rounded-md">Zone administrateur</a>
                            <a href="#sitemap" class="block py-2 px-3 text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400 rounded-md">Plan du site</a>
                        </nav>
                    </div>
                    
                    <div class="col-span-2">
                        <div id="intro" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Introduction</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Cette application permet de gérer les places de parking disponibles, les réservations et la file d'attente. Elle offre une interface simple et intuitive pour faciliter l'attribution des places de parking.
                            </p>
                            <p class="text-gray-600 dark:text-gray-400">
                                Cette documentation vous présente les différentes fonctionnalités de l'application et comment les utiliser efficacement.
                            </p>
                        </div>
                        
                        <div id="access" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Accès et authentification</h2>
                            <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Inscription</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Pour utiliser l'application, vous devez créer un compte en fournissant votre nom, votre adresse e-mail et un mot de passe sécurisé.
                            </p>
                            
                            <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Connexion</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Une fois inscrit, vous pouvez vous connecter à l'application en utilisant votre adresse e-mail et votre mot de passe.
                            </p>
                            
                            <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Récupération de mot de passe</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Si vous avez oublié votre mot de passe, vous pouvez utiliser la fonction "Mot de passe oublié" sur la page de connexion. Vous recevrez un e-mail avec un lien pour réinitialiser votre mot de passe.
                            </p>
                        </div>
                        
                        <div id="places" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Gestion des places</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                La page "Places" vous permet de visualiser l'ensemble des places de parking disponibles et occupées. Vous pouvez :
                            </p>
                            <ul class="list-disc pl-6 mb-4 text-gray-600 dark:text-gray-400 space-y-2">
                                <li>Voir la liste complète des places</li>
                                <li>Filtrer les places disponibles</li>
                                <li>Consulter les détails d'une place spécifique (numéro, statut, réservation actuelle, historique des réservations)</li>
                            </ul>
                        </div>
                        
                        <div id="reservations" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Réservations</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                La section "Réservations" vous permet de gérer vos demandes de réservation de place de parking. Vous pouvez :
                            </p>
                            <ul class="list-disc pl-6 mb-4 text-gray-600 dark:text-gray-400 space-y-2">
                                <li>Faire une demande de réservation</li>
                                <li>Voir votre réservation active</li>
                                <li>Consulter l'historique de vos réservations passées</li>
                                <li>Annuler une réservation en cours</li>
                            </ul>
                            <p class="text-gray-600 dark:text-gray-400">
                                Lorsque vous faites une demande de réservation, le système vous attribue automatiquement une place disponible. Si aucune place n'est disponible, vous êtes ajouté à la file d'attente.
                            </p>
                        </div>
                        
                        <div id="queue" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">File d'attente</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                La page "File d'attente" vous permet de gérer votre position dans la file d'attente lorsque toutes les places sont occupées. Vous pouvez :
                            </p>
                            <ul class="list-disc pl-6 mb-4 text-gray-600 dark:text-gray-400 space-y-2">
                                <li>Voir votre position actuelle dans la file d'attente</li>
                                <li>Vous retirer de la file d'attente si nécessaire</li>
                            </ul>
                            <p class="text-gray-600 dark:text-gray-400">
                                Dès qu'une place se libère, le système attribue automatiquement cette place à la première personne dans la file d'attente.
                            </p>
                        </div>
                        
                        <div id="account" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Gestion du compte</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                L'application vous permet de gérer votre compte utilisateur. Vous pouvez :
                            </p>
                            <ul class="list-disc pl-6 mb-4 text-gray-600 dark:text-gray-400 space-y-2">
                                <li>Modifier votre mot de passe</li>
                                <li>Consulter votre profil utilisateur</li>
                            </ul>
                            <p class="text-gray-600 dark:text-gray-400">
                                Pour modifier votre mot de passe, cliquez sur votre profil en haut à droite, puis sélectionnez "Modifier mon mot de passe".
                            </p>
                        </div>
                        
                        <div id="admin" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Zone administrateur</h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Si vous disposez des droits d'administrateur, vous avez accès à des fonctionnalités supplémentaires :
                            </p>
                            <ul class="list-disc pl-6 mb-4 text-gray-600 dark:text-gray-400 space-y-2">
                                <li>Gestion des utilisateurs (création, modification, suppression)</li>
                                <li>Gestion des places de parking (création, modification, suppression)</li>
                                <li>Attribution manuelle des places</li>
                                <li>Consultation et gestion de la file d'attente</li>
                                <li>Consultation de l'historique complet des attributions</li>
                                <li>Tableau de bord avec statistiques</li>
                            </ul>
                            <p class="text-gray-600 dark:text-gray-400">
                                L'accès à la zone administrateur se fait via le menu "Administration" qui n'apparaît que pour les utilisateurs ayant des droits d'administrateur.
                            </p>
                        </div>
                        
                        <div id="sitemap" class="mb-8">
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Plan du site</h2>
                            <ul class="space-y-4 text-gray-600 dark:text-gray-400">
                                <li>
                                    <span class="font-semibold">Page d'accueil</span> - <code class="text-xs text-primary-600 dark:text-primary-400">/</code>
                                </li>
                                <li>
                                    <span class="font-semibold">Authentification</span>
                                    <ul class="list-disc pl-6 mt-2 space-y-1">
                                        <li>Connexion - <code class="text-xs text-primary-600 dark:text-primary-400">/login</code></li>
                                        <li>Inscription - <code class="text-xs text-primary-600 dark:text-primary-400">/register</code></li>
                                        <li>Mot de passe oublié - <code class="text-xs text-primary-600 dark:text-primary-400">/forgot-password</code></li>
                                        <li>Réinitialisation de mot de passe - <code class="text-xs text-primary-600 dark:text-primary-400">/reset-password/{token}</code></li>
                                        <li>Modification de mot de passe - <code class="text-xs text-primary-600 dark:text-primary-400">/password/change</code></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="font-semibold">Gestion des places</span>
                                    <ul class="list-disc pl-6 mt-2 space-y-1">
                                        <li>Liste des places - <code class="text-xs text-primary-600 dark:text-primary-400">/places</code></li>
                                        <li>Détails d'une place - <code class="text-xs text-primary-600 dark:text-primary-400">/places/{place}</code></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="font-semibold">Réservations</span>
                                    <ul class="list-disc pl-6 mt-2 space-y-1">
                                        <li>Mes réservations - <code class="text-xs text-primary-600 dark:text-primary-400">/reservations</code></li>
                                        <li>Nouvelle réservation - <code class="text-xs text-primary-600 dark:text-primary-400">/reservations/create</code></li>
                                        <li>Historique des réservations - <code class="text-xs text-primary-600 dark:text-primary-400">/reservations/history</code></li>
                                        <li>Détails d'une réservation - <code class="text-xs text-primary-600 dark:text-primary-400">/reservations/{reservation}</code></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="font-semibold">File d'attente</span>
                                    <ul class="list-disc pl-6 mt-2 space-y-1">
                                        <li>Ma position - <code class="text-xs text-primary-600 dark:text-primary-400">/file-attente</code></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="font-semibold">Zone administrateur</span>
                                    <ul class="list-disc pl-6 mt-2 space-y-1">
                                        <li>Tableau de bord - <code class="text-xs text-primary-600 dark:text-primary-400">/admin/dashboard</code></li>
                                        <li>Gestion des utilisateurs - <code class="text-xs text-primary-600 dark:text-primary-400">/admin/utilisateurs</code></li>
                                        <li>Gestion des places - <code class="text-xs text-primary-600 dark:text-primary-400">/admin/places</code></li>
                                        <li>Attribution manuelle - <code class="text-xs text-primary-600 dark:text-primary-400">/admin/attribution</code></li>
                                        <li>Historique d'attribution - <code class="text-xs text-primary-600 dark:text-primary-400">/admin/historique</code></li>
                                        <li>Gestion de la file d'attente - <code class="text-xs text-primary-600 dark:text-primary-400">/admin/file-attente</code></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="font-semibold">Documentation</span> - <code class="text-xs text-primary-600 dark:text-primary-400">/documentation</code>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 