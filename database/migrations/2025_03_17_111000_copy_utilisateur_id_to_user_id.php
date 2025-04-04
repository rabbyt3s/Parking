<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Récupérer toutes les réservations
        $reservations = DB::table('reservations')->get();
        
        foreach ($reservations as $reservation) {
            // Pour chaque réservation, récupérer l'utilisateur correspondant
            $utilisateur = DB::table('utilisateurs')->find($reservation->utilisateur_id);
            
            if ($utilisateur) {
                // Si l'utilisateur existe, trouver l'utilisateur correspondant dans la table users
                $user = DB::table('users')->where('email', $utilisateur->email)->first();
                
                if ($user) {
                    // Mettre à jour la réservation avec l'ID de l'utilisateur
                    DB::table('reservations')
                        ->where('id', $reservation->id)
                        ->update(['user_id' => $user->id]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rien à faire ici, car nous ne voulons pas perdre les données
    }
}; 