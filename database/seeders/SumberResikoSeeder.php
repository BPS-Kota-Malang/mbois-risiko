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
            [ 'name' => 'Internal'],
            [ 'name' => 'Eksternal'],
        ];

        // Insert or update the risk sources
        foreach ($riskSources as $riskSource) {
            DB::table('sumber_resiko')->updateOrInsert(
                ['name' => $riskSource['name']]
            );
        }
    }
}