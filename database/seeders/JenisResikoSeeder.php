<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this line to import the DB facade

class JenisResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the risk types
        $riskTypes = [
            ['name' => 'Negatif'],
            ['name' => 'Positif'],
        ];

        // Insert or update the risk types
        foreach ($riskTypes as $riskType) {
            DB::table('jenis_resiko')->updateOrInsert(
                ['name' => $riskType['name']] // Data to be updated or inserted
            );
        }
    }
}