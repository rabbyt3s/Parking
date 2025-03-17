<!-- Admin Navigation -->
<nav class="mt-5 flex-1 px-2 space-y-1">
    <a href="{{ route('admin.dashboard') }}" 
       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-primary-100 text-primary-900 dark:bg-primary-800/30 dark:text-primary-300' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-primary-500 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400' }}" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h2a1 1 0 001-1v-8m-9 6h10" />
        </svg>
        Tableau de bord
    </a>

    <a href="{{ route('admin.utilisateurs.index') }}" 
       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.utilisateurs.*') ? 'bg-primary-100 text-primary-900 dark:bg-primary-800/30 dark:text-primary-300' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.utilisateurs.*') ? 'text-primary-500 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400' }}" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        Utilisateurs
    </a>

    <a href="{{ route('admin.places.index') }}" 
       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.places.*') ? 'bg-primary-100 text-primary-900 dark:bg-primary-800/30 dark:text-primary-300' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.places.*') ? 'text-primary-500 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400' }}" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Places
    </a>

    <a href="{{ route('admin.attribution.index') }}" 
       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.attribution.*') ? 'bg-primary-100 text-primary-900 dark:bg-primary-800/30 dark:text-primary-300' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.attribution.*') ? 'text-primary-500 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400' }}" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
        </svg>
        Attribution
    </a>

    <a href="{{ route('admin.historique.index') }}" 
       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.historique.*') ? 'bg-primary-100 text-primary-900 dark:bg-primary-800/30 dark:text-primary-300' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.historique.*') ? 'text-primary-500 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400' }}" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Historique
    </a>

    <a href="{{ route('admin.file-attente.index') }}" 
       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.file-attente.*') ? 'bg-primary-100 text-primary-900 dark:bg-primary-800/30 dark:text-primary-300' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.file-attente.*') ? 'text-primary-500 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400' }}" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
        </svg>
        File d'attente
    </a>

    <div class="pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('places.index') }}" 
            class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" 
                class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
            Retour au site
        </a>
    </div>
</nav> 