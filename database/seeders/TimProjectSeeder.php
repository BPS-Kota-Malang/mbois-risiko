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
        // $data = [
        //     ['id' => 1, 'name' => 'Tim Ketahanan Sosial, Susenas dan Sukerduk', 'deskripsi' => 'Deskripsi untuk Tim Ketahanan Sosial, Susenas dan Sukerduk', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 2, 'name' => 'Tim Harga, Distribusi dan jasa', 'deskripsi' => 'Deskripsi untuk Tim Harga, Distribusi dan jasa', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 3, 'name' => 'Tim Analisis, Neraca Produksi dan Konsumsi', 'deskripsi' => 'Deskripsi untuk Tim Analisis, Neraca Produksi dan Konsumsi', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 4, 'name' => 'Tim Pertanian, Industri dan PEK', 'deskripsi' => '	Deskripsi untuk Tim Pertanian, Industri dan PEK', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 5, 'name' => 'Tim Desiminasi, Pengolahan Data dan jaringan', 'deskripsi' => 'Deskripsi untuk Tim Desiminasi, Pengolahan Data dan jaringan', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 6, 'name' => 'Tim SAKIP', 'deskripsi' => 'Deskripsi untuk Tim SAKIP', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 7, 'name' => 'Tim Desa Cantik', 'deskripsi' => 'Deskripsi untuk Tim Desa Cantik', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 8, 'name' => 'Tim Zi dan IPS', 'deskripsi' => 'Deskripsi untuk Tim Zi dan IPS', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 9, 'name' => 'Tim Pojok Statistik', 'deskripsi' => 'Deskripsi untuk Tim Pojok Statistik', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 10, 'name' => 'Tim SDI', 'deskripsi' => 'Deskripsi untuk Tim SDI', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 11, 'name' => 'Tim Humas', 'deskripsi' => 'Deskripsi untuk Tim Humas', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => 12, 'name' => 'Sub Bagian Umum', 'deskripsi' => 'Deskripsi Sub Bagian Umum', 'created_at' => now(), 'updated_at' => now()],
        // ];

        // foreach ($data as $item) {
        //     DB::table('tim_project')->updateOrInsert(
        //         ['id' => $item['id']], // Kondisi untuk memeriksa duplikat
        //         [
        //             'name' => $item['name'],
        //             'deskripsi' => $item['deskripsi'],
        //             'created_at' => $item['created_at'],
        //             'updated_at' => $item['updated_at']
        //         ] // Data yang akan diperbarui atau dimasukkan
        //     );
        // }

        DB::table('tim_project')->insert([
            [
                'name' => 'Sub Bagian Umum',
                'deskripsi' => 'Sub Bagian Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Humas & Pojok Statistik',
                'deskripsi' => 'Humas & Pojok Statistik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diseminasi, Pengolahan Data, Jaringan, SDI & EPSS, PEKPP',
                'deskripsi' => 'Diseminasi, Pengolahan Data, Jaringan, SDI & EPSS, PEKPP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SUSENAS dan SAKERDUK, Ketahanan Sosisal dan Desa Cantik',
                'deskripsi' => 'SUSENAS dan SAKERDUK, Ketahanan Sosisal dan Desa Cantik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pertanian, Industri dan PEK',
                'deskripsi' => 'Pertanian, Industri dan PEK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Distribusi Jasa & Usaha',
                'deskripsi' => 'Distribusi Jasa & Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neraca Produksi & Kosumsi, Analisis',
                'deskripsi' => 'Neraca Produksi & Kosumsi, Analisis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SAKIP & ZI',
                'deskripsi' => 'SAKIP & ZI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
