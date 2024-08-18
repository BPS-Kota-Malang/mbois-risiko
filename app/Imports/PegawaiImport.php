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
                'password' => Hash::make('bpskotamalang123'), // Set a default password
            ]
        );

        // Create or update pegawai
        return Pegawai::updateOrCreate(
            ['user_id' => $user->id],
            [
                'jabatan' => $row['jabatan'],
                'pangkat' => $row['pangkat'],
                'golongan' => $row['golongan'],
                'tim' => $row['tim'],
                'no_hp' => $row['no_hp'],
                'nip' => $row['nip'],
            ]
        );
    }
}
