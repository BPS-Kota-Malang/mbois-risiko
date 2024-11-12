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
        // Create or update user
        $user = User::updateOrCreate(
            ['email' => $row['email']],
            [
                'name' => $row['name'],
                'password' => Hash::make('bpsmalang123'), // Set a default password // spell-check-ignore-line
            ]
        );

        // Create or update pegawai // spell-check-ignore-line
        return Pegawai::updateOrCreate( // spell-check-ignore-line
            ['user_id' => $user->id],
            [
                'name' => $row['nama_pegawai'], // spell-check-ignore-line
                'jabatan' => $row['jabatan'], // spell-check-ignore-line
                'pangkat' => $row['pangkat'], // spell-check-ignore-line
                'golongan' => $row['golongan'], // spell-check-ignore-line
                'tim' => $row['tim'],
                'no_hp' => $row['no_hp'],
                'nip' => $row['nip'],
            ]
        );
    }
}
