<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'resiko' => 'Resiko A', 'status' => 'On Progress', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'resiko' => 'Resiko B', 'status' => 'On Progress', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($data as $item) {
            DB::table('resiko')->updateOrInsert(
                ['id' => $item['id']], // Kondisi untuk memeriksa duplikat
                [
                    'resiko' => $item['resiko'],
                    'status' => $item['status'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at']
                ] // Data yang akan diperbarui atau dimasukkan
            );
        }
    }
}
