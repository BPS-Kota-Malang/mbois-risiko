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
            ['kode' => '01', 'jenis_resiko' => 'Negatif'],
            ['kode' => '02', 'jenis_resiko' => 'Positif'],
        ];

        // Insert or update the risk types
        foreach ($riskTypes as $riskType) {
            DB::table('jenis_resiko')->updateOrInsert(
                ['kode' => $riskType['kode']], // Use 'kode' as the unique identifier
                ['jenis_resiko' => $riskType['jenis_resiko']]
            );
        }
    }
}
