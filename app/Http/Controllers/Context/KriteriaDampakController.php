<?php

namespace App\Http\Controllers\Context;
use App\Models\KriteriaDampak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KriteriaDampakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_area_dampak' => 'required|exists:area_dampak,id',
            'id_level_dampak' => 'required|exists:level_dampak,id',
            'deskripsi_negatif' => 'required|string|max:255',
            'deskripsi_positif' => 'required|string|max:255',
        ]);

        // Simpan data
        KriteriaDampak::create([
            'id_area_dampak' => $request->id_area_dampak,
            'id_level_dampak' => $request->id_level_dampak,
            'deskripsi_negatif' => $request->deskripsi_negatif,
            'deskripsi_positif' => $request->deskripsi_positif,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Dampak created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'id_area_dampak' => 'required|exists:area_dampak,id',
            'id_level_dampak' => 'required|exists:level_dampak,id',
            'deskripsi_negatif' => 'required|string|max:255',
            'deskripsi_positif' => 'required|string|max:255',
        ]);

        // Temukan data berdasarkan ID
        $kriteriaDampak = KriteriaDampak::findOrFail($id);

        // Update data
        $kriteriaDampak->update([
            'id_area_dampak' => $request->id_area_dampak,
            'id_level_dampak' => $request->id_level_dampak,
            'deskripsi_negatif' => $request->deskripsi_negatif,
            'deskripsi_positif' => $request->deskripsi_positif,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Dampak updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan data berdasarkan ID
        $kriteriaDampak = KriteriaDampak::findOrFail($id);

        // Hapus data
        $kriteriaDampak->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Dampak deleted successfully.');
    }
}
