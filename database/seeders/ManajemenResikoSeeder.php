<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManajemenResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('manajemen_resiko')->insert([
            [
                'id_area_dampak' => 1,
                'id_dampak' => json_encode([1, 2]),
                'id_jenis_resiko' => 1,
                'id_kategori_resiko' => 1,
                'id_penyebab' => json_encode([1, 2, 3]),
                'id_resiko' => 1,
                'id_sumber_resiko' => 1,
                'id_tim_project' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_area_dampak' => 2,
                'id_dampak' => json_encode([2, 3]),
                'id_jenis_resiko' => 2,
                'id_kategori_resiko' => 2,
                'id_penyebab' => json_encode([2, 3, 4]),
                'id_resiko' => 2,
                'id_sumber_resiko' => 2,
                'id_tim_project' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data contoh lainnya sesuai kebutuhan
        ]);
    }
}
