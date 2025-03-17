<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère
            $table->dropForeign(['utilisateur_id']);
            
            // Rendre la colonne nullable
            $table->unsignedBigInteger('utilisateur_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Rétablir la contrainte NOT NULL
            $table->unsignedBigInteger('utilisateur_id')->nullable(false)->change();
            
            // Rétablir la contrainte de clé étrangère
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs');
        });
    }
};
