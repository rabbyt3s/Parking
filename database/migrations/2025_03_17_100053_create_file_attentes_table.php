<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_attentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs');
            $table->integer('position');
            $table->dateTime('date_demande');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_attentes');
    }
};