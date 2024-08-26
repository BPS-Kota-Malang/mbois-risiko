<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'nama_team' => 'Tim A', 'deskripsi' => 'Deskripsi Tim A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_team' => 'Tim B', 'deskripsi' => 'Deskripsi Tim B', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($data as $item) {
            DB::table('tim_project')->updateOrInsert(
                ['id' => $item['id']], // Kondisi untuk memeriksa duplikat
                [
                    'nama_team' => $item['nama_team'],
                    'deskripsi' => $item['deskripsi'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at']
                ] // Data yang akan diperbarui atau dimasukkan
            );
        }
    }
}
