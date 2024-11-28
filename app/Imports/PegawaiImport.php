<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pastikan bahwa kolom dari Excel seperti 'email', 'name', dll., sesuai dengan header di Excel
        $user = User::updateOrCreate(
            ['email' => $row['email']], // Cari berdasarkan email
            [
                'name' => $row['name'], // Gunakan nama dari Excel
                'password' => Hash::make('bpsmalang123'), // Set password default
            ]
        );

        // Update atau buat data pegawai berdasarkan user_id dari User yang baru saja dibuat
        return Pegawai::updateOrCreate(
            ['user_id' => $user->id], // Cari pegawai berdasarkan user_id
            [
                'name' => $row['name'], // Sesuaikan nama pegawai dari Excel
                'nip' => $row['nip'], // Nomor Induk Pegawai
                'jabatan' => $row['jabatan'], // Jabatan dari Excel
                'pangkat' => $row['pangkat'], // Pangkat dari Excel
                'golongan' => $row['golongan'], // Golongan dari Excel
                'id_tim' => $this->getTimId($row['tim']), // Fungsi untuk mendapatkan ID tim dari nama
                'no_hp' => $row['no_hp'], // Nomor HP dari Excel
            ]
        );
    }

    // Fungsi untuk mendapatkan id_tim berdasarkan nama tim di Excel
    private function getTimId($namaTim)
    {
        // Misal tabel 'tim_project' memiliki kolom 'name' untuk nama tim
        $tim = \App\Models\TimProject::where('name', $namaTim)->first();
        return $tim ? $tim->id : null; // Jika tim ditemukan, return id, jika tidak return null
    }
}
