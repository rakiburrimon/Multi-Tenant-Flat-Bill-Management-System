<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bill_categories')->delete();

        DB::table('bill_categories')->insert([
            [
                'name' => 'Electricity',
                'description' => 'Monthly electricity charges',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gas bill',
                'description' => 'Monthly gas charges',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Water bill',
                'description' => 'Monthly water charges',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Utility Charges',
                'description' => 'Common area maintenance and utilities',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


