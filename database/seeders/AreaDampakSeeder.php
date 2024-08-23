<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaDampakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'area_dampak' => 'Finansial'],
            ['id' => 2, 'area_dampak' => 'Operasional'],
            ['id' => 3, 'area_dampak' => 'Reputasi'],
        ];

        foreach ($data as $item) {
            DB::table('area_dampak')->updateOrInsert(
                ['id' => $item['id']], // Kondisi untuk memeriksa duplikat
                ['area_dampak' => $item['area_dampak']] // Data yang akan diperbarui atau dimasukkan
            );
        }
    }
}
