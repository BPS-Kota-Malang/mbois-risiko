<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subteams')->insert([
            [
                'name' => 'Humas',
                'tim_project_id' => 2,
                'description' => 'Humas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Potik UB',
                'tim_project_id' => 2,
                'description' => 'Potik UB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Potik UM',
                'tim_project_id' => 2,
                'description' => 'Potik UM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diseminasi, Pengolahan Data, Jaringan, PEKPP',
                'tim_project_id' => 3,
                'description' => 'Diseminasi, Pengolahan Data, Jaringan, PEKPP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SDI & EPSS',
                'tim_project_id' => 3,
                'description' => 'SDI & EPSS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Susenas',
                'tim_project_id' => 4,
                'description' => 'Susenas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ketahanan Sosial',
                'tim_project_id' => 4,
                'description' => 'Ketahanan Sosial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sakernas',
                'tim_project_id' => 4,
                'description' => 'Sakernas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desa Cantik',
                'tim_project_id' => 4,
                'description' => 'Desa Cantik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pertanian',
                'tim_project_id' => 5,
                'description' => 'Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Industri & PEK',
                'tim_project_id' => 5,
                'description' => 'Industri & PEK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Disjas',
                'tim_project_id' => 6,
                'description' => 'Disjas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Harga',
                'tim_project_id' => 6,
                'description' => 'Harga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neraca Produksi',
                'tim_project_id' => 7,
                'description' => 'Neraca Produksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Analisis',
                'tim_project_id' => 7,
                'description' => 'Analisis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SAKIP',
                'tim_project_id' => 8,
                'description' => 'SAKIP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zona Integritas',
                'tim_project_id' => 8,
                'description' => 'Zona Integritas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
