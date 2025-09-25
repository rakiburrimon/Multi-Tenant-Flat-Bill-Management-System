<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillsTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = DB::table('bill_categories')->pluck('id', 'name');
        $flats = DB::table('flats')->get();
        $tenantsByFlat = DB::table('tenants')->get()->groupBy('flat_id');

        if ($flats->isEmpty() || $categories->isEmpty()) {
            return; // depends on Flats and Categories
        }

        DB::table('bills')->delete();

        $rows = [];
        foreach ($flats as $flat) {
            $tenantId = optional($tenantsByFlat->get($flat->id))[0]->id ?? null;

            // Create three bills per flat: last month (paid), this month (unpaid), two months ago (overdue)
            // Paid bill (last month)
            $rows[] = [
                'house_owner_id' => $flat->house_owner_id,
                'flat_id' => $flat->id,
                'tenant_id' => $tenantId,
                'category_id' => $categories['Electricity'] ?? $categories->first(),
                'amount' => 1200.00,
                'due_date' => now()->subMonth()->endOfMonth()->toDateString(),
                'status' => 'paid',
                'paid_at' => now()->subDays(10),
                'remarks' => 'Paid via bank transfer',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subDays(10),
            ];

            // Current month unpaid
            $rows[] = [
                'house_owner_id' => $flat->house_owner_id,
                'flat_id' => $flat->id,
                'tenant_id' => $tenantId,
                'category_id' => $categories['Water bill'] ?? $categories->first(),
                'amount' => 800.00,
                'due_date' => now()->endOfMonth()->toDateString(),
                'status' => 'unpaid',
                'paid_at' => null,
                'remarks' => 'Awaiting payment',
                'created_at' => now()->startOfMonth(),
                'updated_at' => now(),
            ];

            // Overdue from two months ago
            $rows[] = [
                'house_owner_id' => $flat->house_owner_id,
                'flat_id' => $flat->id,
                'tenant_id' => $tenantId,
                'category_id' => $categories['Gas bill'] ?? $categories->first(),
                'amount' => 950.50,
                'due_date' => now()->subMonths(2)->endOfMonth()->toDateString(),
                'status' => 'overdue',
                'paid_at' => null,
                'remarks' => 'Carried forward due',
                'created_at' => now()->subMonths(2)->startOfMonth(),
                'updated_at' => now()->subMonth(),
            ];
        }

        DB::table('bills')->insert($rows);
    }
}


