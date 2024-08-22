<?php

namespace App\Http\Controllers\Context;

use App\Models\KriteriaKemungkinan;
use App\Models\KategoriResiko;
use App\Models\LevelKemungkinan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KriteriaKemungkinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = KriteriaKemungkinan::query();

    // Apply filters
    if ($request->has('kategori_resiko') && $request->kategori_resiko) {
        $query->where('id_kategori_resiko', $request->kategori_resiko);
    }

    $kriteriaKemungkinan = $query->get();

    $kategoriResiko = KategoriResiko::all(); // Assuming you want to populate dropdown options

    return view('admin.risk.context', compact('kriteriaKemungkinan', 'kategoriResiko'));
}

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Optional: Jika form untuk pembuatan berada di halaman terpisah, Anda bisa load data yang diperlukan di sini.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'id_level_kemungkinan' => 'required|exists:level_kemungkinan,id',
            'presentase_kemungkinan' => 'required|string|max:255',
            'jumlah_frekuensi' => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database
        KriteriaKemungkinan::create([
            'id_kategori_resiko' => $request->id_kategori_resiko,
            'id_level_kemungkinan' => $request->id_level_kemungkinan,
            'presentase_kemungkinan' => $request->presentase_kemungkinan,
            'jumlah_frekuensi' => $request->jumlah_frekuensi,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Kemungkinan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Optional: Jika Anda ingin menampilkan detail dari sebuah Kriteria Kemungkinan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Optional: Jika form untuk pengeditan berada di halaman terpisah, Anda bisa load data yang diperlukan di sini.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari form
        $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'id_level_kemungkinan' => 'required|exists:level_kemungkinan,id',
            'presentase_kemungkinan' => 'required|string|max:255',
            'jumlah_frekuensi' => 'required|string|max:255',
        ]);

        // Cari data berdasarkan ID dan update
        $kriteriaKemungkinan = KriteriaKemungkinan::findOrFail($id);
        $kriteriaKemungkinan->update([
            'id_kategori_resiko' => $request->id_kategori_resiko,
            'id_level_kemungkinan' => $request->id_level_kemungkinan,
            'presentase_kemungkinan' => $request->presentase_kemungkinan,
            'jumlah_frekuensi' => $request->jumlah_frekuensi,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Kemungkinan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data berdasarkan ID dan hapus
        $kriteriaKemungkinan = KriteriaKemungkinan::findOrFail($id);
        $kriteriaKemungkinan->delete();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Kemungkinan deleted successfully.');
    }
}