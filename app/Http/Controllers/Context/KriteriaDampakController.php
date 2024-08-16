<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\KriteriaDampak;
use Illuminate\Http\Request;

class KriteriaDampakController extends Controller
{
    public function storeKriteriaDampak(Request $request)
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

    public function updateKriteriaDampak(Request $request, $id)
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

    public function destroyKriteriaDampak($id)
    {
        // Temukan data berdasarkan ID
        $kriteriaDampak = KriteriaDampak::findOrFail($id);

        // Hapus data
        $kriteriaDampak->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Dampak deleted successfully.');
    }
}
