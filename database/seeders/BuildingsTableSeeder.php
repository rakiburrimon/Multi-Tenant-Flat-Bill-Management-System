<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingsTableSeeder extends Seeder
{
    public function run(): void
    {
        $aliceId = DB::table('users')->where('email', 'alice.owner@example.com')->value('id');
        $bobId = DB::table('users')->where('email', 'bob.owner@example.com')->value('id');

        if (!$aliceId || !$bobId) {
            return; // depends on Users seeder
        }

        DB::table('buildings')->delete();

        DB::table('buildings')->insert([
            [
                'house_owner_id' => $aliceId,
                'name' => 'Maple Residency',
                'address' => '123 Maple St',
                'city' => 'Springfield',
                'postcode' => 'SP1 2AB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'house_owner_id' => $aliceId,
                'name' => 'Oak View Apartments',
                'address' => '45 Oak Ave',
                'city' => 'Springfield',
                'postcode' => 'SP3 4CD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'house_owner_id' => $bobId,
                'name' => 'Riverfront Towers',
                'address' => '9 River Rd',
                'city' => 'Riverside',
                'postcode' => 'RV5 6EF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


