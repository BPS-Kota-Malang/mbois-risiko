<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProsesBisnisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the business processes
        $businessProcesses = [
            ['name' => 'Persiapan'],
            ['name' => 'Pelaksanaan'],
            ['name' => 'Pengolahan'],
            ['name' => 'Hasil'],
            ['name' => 'Desiminasi'],
        ];

        // Insert or update the business processes
        foreach ($businessProcesses as $process) {
            DB::table('proses_bisnis')->updateOrInsert(
                ['name' => $process['name']], // Use 'proses_bisnis' as the unique identifier
                $process
            );
        }
    }
}