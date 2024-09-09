<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LevelDampakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('level_dampak')->insert([
            [
                'level_dampak' => 'Tidak Signifikan',
                'deskripsi' => 'Dampak sangat kecil, tidak mempengaruhi operasional',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_dampak' => 'Kurang Signifikan MINOR',
                'deskripsi' => 'Dampak kecil, sedikit mempengaruhi operasional',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_dampak' => 'Cukup Signifikan MODERATE',
                'deskripsi' => 'Dampak sedang, mempengaruhi operasional secara signifikan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_dampak' => 'Signifikan ',
                'deskripsi' => 'Dampak besar, sangat mempengaruhi operasional',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_dampak' => 'Sangat Signifikan ',
                'deskripsi' => 'Dampak sangat besar, menghentikan operasional',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
