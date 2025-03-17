<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Vérifier si l'utilisateur existe déjà
        $user = DB::table('users')->where('email', 'admin@example.com')->first();
        
        if (!$user) {
            // Créer un utilisateur administrateur
            DB::table('users')->insert([
                'name' => 'Administrateur',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'est_admin' => true,
                'est_valide' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            // Mettre à jour l'utilisateur existant pour le rendre administrateur
            DB::table('users')
                ->where('email', 'admin@example.com')
                ->update(['est_admin' => true]);
        }
        
        // Mettre à jour l'utilisateur actuel pour le rendre administrateur (si vous êtes déjà connecté)
        DB::table('users')
            ->where('id', 1)
            ->update(['est_admin' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rien à faire ici
    }
}; 