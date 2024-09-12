<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KategoriResiko;
use App\Models\Resiko;
use Carbon\Carbon; // Tambahkan Carbon untuk bekerja dengan tanggal

use App\Models\User;
use App\Models\KategoriResiko;
use App\Models\Resiko;
use Carbon\Carbon; // Tambahkan Carbon untuk bekerja dengan tanggal

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        // Menghitung jumlah pengguna
        $totalUsers = User::count();

=======

        // Menghitung jumlah pengguna
        $totalUsers = User::count();
        
>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
        // Menghitung jumlah kategori risiko
        $totalKategoriResiko = KategoriResiko::count();

        // Menghitung jumlah risiko
        $totalResiko = Resiko::count();

        // Menghitung jumlah risiko berdasarkan status
        $riskCounts = Resiko::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // Siapkan data untuk Pie Chart
        $riskData = [
            'values' => [
                $riskCounts->get('Accepted', 0),
                $riskCounts->get('On Progress', 0),
                $riskCounts->get('Rejected', 0),
            ],
        ];

        // Menghitung jumlah risiko per bulan
        $monthlyRisks = Resiko::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year) // Hanya menghitung risiko tahun ini
            ->groupBy('month')
            ->pluck('total', 'month');

        // Siapkan data total risiko per bulan untuk Line Chart
        $monthlyRiskData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyRiskData[$i] = $monthlyRisks->get($i, 0); // Jika tidak ada data, set ke 0
        }

        // Mengembalikan view 'admin.dashboard' dengan data yang diperlukan
        return view('admin.dashboard', compact('totalUsers', 'totalResiko', 'totalKategoriResiko', 'riskData', 'monthlyRiskData'));
<<<<<<< HEAD
=======

>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logika untuk menampilkan form pembuatan resource baru (jika diperlukan)
<<<<<<< HEAD
=======

>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // Logika untuk menyimpan data yang diinput di form (jika diperlukan)
=======

        // Logika untuk menyimpan data yang diinput di form (jika diperlukan)

        //

>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
<<<<<<< HEAD
        // Logika untuk menampilkan detail resource tertentu (jika diperlukan)
=======

>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
<<<<<<< HEAD
        // Logika untuk menampilkan form edit resource tertentu (jika diperlukan)
=======

>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
<<<<<<< HEAD
        // Logika untuk memperbarui resource tertentu (jika diperlukan)
=======

>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
<<<<<<< HEAD
        // Logika untuk menghapus resource tertentu (jika diperlukan)
=======

>>>>>>> 66706489f70e9320b6c7d802d4fdbd3223c9bb56
    }

}