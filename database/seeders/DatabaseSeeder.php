<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $levels = [
            ['name' => 'Recolector Consciente', 'level_min' => 0, 'level_max' => 999],
            ['name' => 'Defensor del Planeta', 'level_min' => 1000, 'level_max' => 2499],
            ['name' => 'Guardián del Reciclaje', 'level_min' => 2500, 'level_max' => 4999],
            ['name' => 'EcoHéroe', 'level_min' => 5000, 'level_max' => 9999],
            ['name' => 'Maestro del Cero Desperdicio', 'level_min' => 10000, 'level_max' => 999999],
        ];

        foreach ($levels as $level) {
            Level::firstOrCreate(['name' => $level['name']], $level);
        }
    }
}
