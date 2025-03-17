<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;
    
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero',
        'description',
        'est_disponible',
    ];
    
    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'est_disponible' => 'boolean',
    ];
    
    /**
     * Obtenir les réservations pour cette place.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    
    /**
     * Obtenir les réservations actives pour cette place.
     */
    public function reservationsActives()
    {
        return $this->reservations()->where('est_active', true);
    }
    
    /**
     * Vérifier si la place est actuellement réservée.
     */
    public function estReservee(): bool
    {
        return !$this->est_disponible;
    }
}
