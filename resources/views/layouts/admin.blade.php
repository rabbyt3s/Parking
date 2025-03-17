<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des Places de Parking</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header">
                <h3>Administration</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Tableau de bord
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.utilisateurs.index') }}">
                        <i class="fas fa-users"></i> Gestion des Utilisateurs
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.places.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.places.index') }}">
                        <i class="fas fa-parking"></i> Gestion des Places
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.attribution.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.attribution.index') }}">
                        <i class="fas fa-hand-holding"></i> Attribution Manuelle
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.historique.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.historique.index') }}">
                        <i class="fas fa-history"></i> Historique
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.file-attente.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.file-attente.index') }}">
                        <i class="fas fa-list"></i> File d'Attente
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="ml-auto">
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html> 