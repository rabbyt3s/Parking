<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si des places existent déjà
        if (Place::count() > 0) {
            $this->command->info('Des places existent déjà dans la base de données. Aucune place n\'a été ajoutée.');
            return;
        }

        // Créer 20 places de parking
        for ($i = 1; $i <= 20; $i++) {
            Place::create([
                'numero' => 'P' . str_pad($i, 3, '0', STR_PAD_LEFT), // Format: P001, P002, etc.
                'description' => 'Place de parking n°' . $i . ' - Niveau ' . ceil($i / 5),
                'est_disponible' => true,
            ]);
        }

        $this->command->info('20 places de parking ont été créées avec succès.');
    }
} 