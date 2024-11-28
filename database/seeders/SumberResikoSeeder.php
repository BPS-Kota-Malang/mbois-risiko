<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SumberResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the risk sources
        $riskSources = [
            ['kode' => '01', 'sumber_resiko' => 'Internal'],
            ['kode' => '02', 'sumber_resiko' => 'Eksternal'],
        ];

        // Insert or update the risk sources
        foreach ($riskSources as $riskSource) {
            DB::table('sumber_resiko')->updateOrInsert(
                ['kode' => $riskSource['kode']], // Use 'kode' as the unique identifier
                ['sumber_resiko' => $riskSource['sumber_resiko']]
            );
        }
    }
}
