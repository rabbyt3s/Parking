@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Historique des Attributions</h3>
                </div>
                <div class="card-body">
                    <!-- Formulaire de recherche -->
                    <form action="{{ route('admin.historique.search') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user_id">Utilisateur</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Tous les utilisateurs</option>
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="place_id">Place</label>
                                    <select name="place_id" id="place_id" class="form-control">
                                        <option value="">Toutes les places</option>
                                        @foreach(\App\Models\Place::all() as $place)
                                            <option value="{{ $place->id }}" {{ request('place_id') == $place->id ? 'selected' : '' }}>
                                                {{ $place->numero }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_debut">Date début</label>
                                    <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_fin">Date fin</label>
                                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Rechercher</button>
                                <a href="{{ route('admin.historique.index') }}" class="btn btn-secondary">Réinitialiser</a>
                            </div>
                        </div>
                    </form>

                    <!-- Tableau des résultats -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Utilisateur</th>
                                    <th>Place</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>{{ $reservation->place->numero }}</td>
                                        <td>
                                            @if($reservation->date_fin < now())
                                                <span class="badge badge-secondary">Expirée</span>
                                            @else
                                                <span class="badge badge-success">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.historique.show', $reservation) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $reservations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 