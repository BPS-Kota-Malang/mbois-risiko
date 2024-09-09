<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LevelResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('level_resiko')->insert([
            [
                'level_resiko' => 'sangat rendah',
                'besaran_min' => '1',
                'besaran_max' => '5',
                'tindakan' => 'Pengaruh terhadap capaian tujuan sangat rendah',
                'ket_warna' => 'biru',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_resiko' => 'rendah',
                'besaran_min' => '6',
                'besaran_max' => '10',
                'tindakan' => 'Pengaruh terhadap capaian tujuan rendah',
                'ket_warna' => 'hijau',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_resiko' => 'sedang',
                'besaran_min' => '11',
                'besaran_max' => '14',
                'tindakan' => 'Penganaruh terhadap capaian tujuan sedang',
                'ket_warna' => 'kuning',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_resiko' => 'tinggi',
                'besaran_min' => '15',
                'besaran_max' => '19',
                'tindakan' => 'Pengaruh terhadap capaian tujuan besar',
                'ket_warna' => 'oranye',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'level_resiko' => 'sangat tinggi',
                'besaran_min' => '20',
                'besaran_max' => '25',
                'tindakan' => 'Pengaruh terhadap capaian tujuan sangat besar',
                'ket_warna' => 'merah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
