<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlatsTableSeeder extends Seeder
{
    public function run(): void
    {
        $buildings = DB::table('buildings')->get();
        if ($buildings->isEmpty()) {
            return; // depends on Buildings seeder
        }

        DB::table('flats')->delete();

        $rows = [];
        foreach ($buildings as $building) {
            // Create 3 flats per building
            for ($i = 1; $i <= 3; $i++) {
                $rows[] = [
                    'building_id' => $building->id,
                    'house_owner_id' => $building->house_owner_id,
                    'number' => 'F' . $i,
                    'floor' => $i,
                    'description' => 'Flat ' . $i . ' in ' . ($building->name ?? 'Building #' . $building->id),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('flats')->insert($rows);
    }
}


