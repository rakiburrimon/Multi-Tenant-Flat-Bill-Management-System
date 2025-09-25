<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantsTableSeeder extends Seeder
{
    public function run(): void
    {
        $flats = DB::table('flats')->get();
        if ($flats->isEmpty()) {
            return; // depends on Flats seeder
        }

        DB::table('tenants')->delete();

        $tenantIndex = 1;
        $rows = [];
        foreach ($flats as $flat) {
            // Assign a tenant to first two flats of each building
            if (in_array($flat->number, ['F1', 'F2'])) {
                $rows[] = [
                    'house_owner_id' => $flat->house_owner_id,
                    'flat_id' => $flat->id,
                    'name' => 'Tenant ' . $tenantIndex,
                    'email' => 'tenant' . $tenantIndex . '@example.com',
                    'phone' => '07000' . str_pad((string)$tenantIndex, 5, '0', STR_PAD_LEFT),
                    'lease_start' => now()->subMonths(6)->toDateString(),
                    'lease_end' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $tenantIndex++;
            }
        }

        if (!empty($rows)) {
            DB::table('tenants')->insert($rows);
        }
    }
}


