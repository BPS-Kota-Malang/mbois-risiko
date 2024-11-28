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
            ['proses_bisnis' => 'Persiapan'],
            ['proses_bisnis' => 'Pelaksanaan'],
            ['proses_bisnis' => 'Pengolahan'],
            ['proses_bisnis' => 'Hasil'],
            ['proses_bisnis' => 'Desiminasi'],
        ];

        // Insert or update the business processes
        foreach ($businessProcesses as $process) {
            DB::table('proses_bisnis')->updateOrInsert(
                ['proses_bisnis' => $process['proses_bisnis']], // Use 'proses_bisnis' as the unique identifier
                $process
            );
        }
    }
}
