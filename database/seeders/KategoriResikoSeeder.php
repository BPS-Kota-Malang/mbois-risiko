<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'definisi' => 'Definisi Strategis', 'deskripsi' => 'Deskripsi Strategis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'definisi' => 'Definisi Operasional', 'deskripsi' => 'Deskripsi Operasional', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'definisi' => 'Definisi Kepatuhan', 'deskripsi' => 'Deskripsi Kepatuhan', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($data as $item) {
            DB::table('kategori_resiko')->updateOrInsert(
                ['id' => $item['id']], // Kondisi untuk memeriksa duplikat
                [
                    'definisi' => $item['definisi'],
                    'deskripsi' => $item['deskripsi'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at']
                ] // Data yang akan diperbarui atau dimasukkan
            );
        }
    }
}
