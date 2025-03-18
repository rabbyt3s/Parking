<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;

final class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'est_admin',
        'est_valide',
        'force_password_change',
    ];

    /**
     * Les attributs qui doivent être cachés.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'est_admin' => 'boolean',
        'est_valide' => 'boolean',
        'force_password_change' => 'boolean',
    ];

    /**
     * Obtenir les réservations de l'utilisateur.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Obtenir la position de l'utilisateur dans la file d'attente.
     */
    public function fileAttente(): HasOne
    {
        return $this->hasOne(FileAttente::class);
    }

    /**
     * Vérifier si l'utilisateur est un administrateur.
     */
    public function estAdmin(): bool
    {
        return $this->est_admin;
    }
}
