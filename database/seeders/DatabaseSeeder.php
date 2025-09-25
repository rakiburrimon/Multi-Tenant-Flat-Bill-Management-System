<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Clean tables for idempotent demo seeds
        DB::table('bills')->truncate();
        DB::table('tenants')->truncate();
        DB::table('flats')->truncate();
        DB::table('buildings')->truncate();
        DB::table('bill_categories')->truncate();
        DB::table('users')->truncate();

        Schema::enableForeignKeyConstraints();

        $this->call([
            UsersTableSeeder::class,
            BuildingsTableSeeder::class,
            FlatsTableSeeder::class,
            TenantsTableSeeder::class,
            BillCategoriesTableSeeder::class,
            BillsTableSeeder::class,
        ]);
    }
}
