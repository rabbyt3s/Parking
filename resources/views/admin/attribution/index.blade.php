@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attribution Manuelle des Places</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Formulaire d'attribution -->
                    <form action="{{ route('admin.attribution.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_id">Utilisateur</label>
                                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="place_id">Place</label>
                                    <select name="place_id" id="place_id" class="form-control @error('place_id') is-invalid @enderror" required>
                                        <option value="">Sélectionner une place</option>
                                        @foreach($places as $place)
                                            <option value="{{ $place->id }}" {{ old('place_id') == $place->id ? 'selected' : '' }}>
                                                {{ $place->numero }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('place_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duree">Durée (en jours)</label>
                                    <input type="number" 
                                           name="duree" 
                                           id="duree" 
                                           class="form-control @error('duree') is-invalid @enderror" 
                                           value="{{ old('duree', 30) }}" 
                                           min="1" 
                                           max="365" 
                                           required>
                                    @error('duree')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Attribuer la place</button>
                            </div>
                        </div>
                    </form>

                    <!-- Liste des réservations actives -->
                    <h4 class="mt-4">Réservations Actives</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Place</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Reservation::with(['user', 'place'])
                                    ->where('date_fin', '>', now())
                                    ->orderBy('date_fin')
                                    ->get() as $reservation)
                                    <tr>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>{{ $reservation->place->numero }}</td>
                                        <td>{{ $reservation->date_debut->format('d/m/Y') }}</td>
                                        <td>{{ $reservation->date_fin->format('d/m/Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.attribution.terminer', $reservation) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir terminer cette réservation ?')">
                                                    <i class="fas fa-times"></i> Terminer
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
</div>
@endsection 