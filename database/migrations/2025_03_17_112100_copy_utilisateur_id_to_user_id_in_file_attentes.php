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
        // Récupérer toutes les entrées de la file d'attente
        $fileAttentes = DB::table('file_attentes')->get();
        
        foreach ($fileAttentes as $fileAttente) {
            // Pour chaque entrée, récupérer l'utilisateur correspondant
            $utilisateur = DB::table('utilisateurs')->find($fileAttente->utilisateur_id);
            
            if ($utilisateur) {
                // Si l'utilisateur existe, trouver l'utilisateur correspondant dans la table users
                $user = DB::table('users')->where('email', $utilisateur->email)->first();
                
                if ($user) {
                    // Mettre à jour l'entrée avec l'ID de l'utilisateur
                    DB::table('file_attentes')
                        ->where('id', $fileAttente->id)
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