@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails de la Réservation</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Informations de la Réservation</h4>
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $reservation->id }}</td>
                                </tr>
                                <tr>
                                    <th>Date de création</th>
                                    <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Date d'expiration</th>
                                    <td>{{ $reservation->date_fin->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Statut</th>
                                    <td>
                                        @if($reservation->date_fin < now())
                                            <span class="badge badge-secondary">Expirée</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Informations de l'Utilisateur</h4>
                            <table class="table">
                                <tr>
                                    <th>Nom</th>
                                    <td>{{ $reservation->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $reservation->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Rôle</th>
                                    <td>
                                        @if($reservation->user->est_admin)
                                            <span class="badge badge-primary">Administrateur</span>
                                        @else
                                            <span class="badge badge-secondary">Utilisateur</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Informations de la Place</h4>
                            <table class="table">
                                <tr>
                                    <th>Numéro de place</th>
                                    <td>{{ $reservation->place->numero }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $reservation->place->description ?? 'Aucune description' }}</td>
                                </tr>
                                <tr>
                                    <th>Statut actuel</th>
                                    <td>
                                        @if($reservation->place->est_disponible)
                                            <span class="badge badge-success">Disponible</span>
                                        @else
                                            <span class="badge badge-danger">Occupée</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{ route('admin.historique.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour à l'historique
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 