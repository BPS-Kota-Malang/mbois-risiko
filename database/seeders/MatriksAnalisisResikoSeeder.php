<?php
// database/seeders/MatriksAnalisisResikoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatriksAnalisisResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definisikan data level kemungkinan dan level dampak
        $levelKemungkinan = [
            ['id' => 1, 'name' => 'Hampir tidak terjadi'],
            ['id' => 2, 'name' => 'Jarang terjadi'],
            ['id' => 3, 'name' => 'Kadang terjadi'],
            ['id' => 4, 'name' => 'Sering terjadi'],
            ['id' => 5, 'name' => 'Hampir pasti terjadi'],
        ];

        $levelDampak = [
            ['id' => 1, 'name' => 'Tidak Signifikan'],
            ['id' => 2, 'name' => 'Kurang Signifikan MINOR'],
            ['id' => 3, 'name' => 'Cukup Signifikan MODERATE'],
            ['id' => 4, 'name' => 'Signifikan'],
            ['id' => 5, 'name' => 'Sangat Signifikan'],
        ];

        // Insert or update data level kemungkinan
        foreach ($levelKemungkinan as $kemungkinan) {
            DB::table('level_kemungkinan')->updateOrInsert(
                ['id' => $kemungkinan['id']],
                ['name' => $kemungkinan['name']]
            );
        }

        // Insert or update data level dampak
        foreach ($levelDampak as $dampak) {
            DB::table('level_dampak')->updateOrInsert(
                ['id' => $dampak['id']],
                ['name' => $dampak['name']]
            );
        }

        // Definisikan data matriks analisis risiko
        $matriksAnalisisResiko = [
            ['id_level_kemungkinan' => 1, 'id_level_dampak' => 1, 'besaran_resiko' => '1', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 1, 'id_level_dampak' => 2, 'besaran_resiko' => '2', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 1, 'id_level_dampak' => 3, 'besaran_resiko' => '3', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 1, 'id_level_dampak' => 4, 'besaran_resiko' => '4', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 1, 'id_level_dampak' => 5, 'besaran_resiko' => '5', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 2, 'id_level_dampak' => 1, 'besaran_resiko' => '2', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 2, 'id_level_dampak' => 2, 'besaran_resiko' => '4', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 3, 'id_level_dampak' => 1, 'besaran_resiko' => '3', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 4, 'id_level_dampak' => 1, 'besaran_resiko' => '4', 'hasil_level_resiko' => 'Sangat Rendah'],
            ['id_level_kemungkinan' => 5, 'id_level_dampak' => 1, 'besaran_resiko' => '5', 'hasil_level_resiko' => 'Sangat Rendah'],

            ['id_level_kemungkinan' => 2, 'id_level_dampak' => 3, 'besaran_resiko' => '6', 'hasil_level_resiko' => 'Rendah'],
            ['id_level_kemungkinan' => 2, 'id_level_dampak' => 4, 'besaran_resiko' => '8', 'hasil_level_resiko' => 'Rendah'],
            ['id_level_kemungkinan' => 2, 'id_level_dampak' => 5, 'besaran_resiko' => '10', 'hasil_level_resiko' => 'Rendah'],
            ['id_level_kemungkinan' => 3, 'id_level_dampak' => 2, 'besaran_resiko' => '6', 'hasil_level_resiko' => 'Rendah'],
            ['id_level_kemungkinan' => 3, 'id_level_dampak' => 3, 'besaran_resiko' => '9', 'hasil_level_resiko' => 'Rendah'],
            ['id_level_kemungkinan' => 4, 'id_level_dampak' => 2, 'besaran_resiko' => '8', 'hasil_level_resiko' => 'Rendah'],
            ['id_level_kemungkinan' => 5, 'id_level_dampak' => 2, 'besaran_resiko' => '10', 'hasil_level_resiko' => 'Rendah'],

            ['id_level_kemungkinan' => 3, 'id_level_dampak' => 4, 'besaran_resiko' => '12', 'hasil_level_resiko' => 'Sedang'],
            ['id_level_kemungkinan' => 4, 'id_level_dampak' => 3, 'besaran_resiko' => '12', 'hasil_level_resiko' => 'Sedang'],

            ['id_level_kemungkinan' => 3, 'id_level_dampak' => 5, 'besaran_resiko' => '15', 'hasil_level_resiko' => 'Tinggi'],
            ['id_level_kemungkinan' => 4, 'id_level_dampak' => 4, 'besaran_resiko' => '16', 'hasil_level_resiko' => 'Tinggi'],
            ['id_level_kemungkinan' => 5, 'id_level_dampak' => 3, 'besaran_resiko' => '15', 'hasil_level_resiko' => 'Tinggi'],

            ['id_level_kemungkinan' => 4, 'id_level_dampak' => 5, 'besaran_resiko' => '20', 'hasil_level_resiko' => 'Sangat Tinggi'],
            ['id_level_kemungkinan' => 5, 'id_level_dampak' => 4, 'besaran_resiko' => '20', 'hasil_level_resiko' => 'Sangat Tinggi'],
            ['id_level_kemungkinan' => 5, 'id_level_dampak' => 5, 'besaran_resiko' => '25', 'hasil_level_resiko' => 'Sangat Tinggi'],
        ];

        // Insert data matriks analisis risiko
        DB::table('matriks_analisis_resiko')->insert($matriksAnalisisResiko);
    }
}