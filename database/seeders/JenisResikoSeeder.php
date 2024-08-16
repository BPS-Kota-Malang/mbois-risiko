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
            ['kode' => 'R001', 'jenis_resiko' => 'Resiko Tinggi'],
            ['kode' => 'R002', 'jenis_resiko' => 'Resiko Sedang'],
            ['kode' => 'R003', 'jenis_resiko' => 'Resiko Rendah'],
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
