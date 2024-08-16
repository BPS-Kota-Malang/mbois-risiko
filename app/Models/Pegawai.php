<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
        // Tentukan tabel yang digunakan oleh model ini (opsional jika nama tabel tidak sesuai konvensi)
        protected $table = 'data_pegawai';

        // Tentukan atribut yang dapat diisi (mass assignable)
        protected $fillable = [
            'user_id',
            'jabatan',
            'pangkat',
            'golongan',
            'tim',
            'no_hp',
            'nip',
        ];

        // Tentukan atribut yang harus di-cast ke tipe data tertentu
        protected $casts = [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];

        // Definisikan relasi ke model User
}
