<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\KriteriaKemungkinan;
use Illuminate\Http\Request;

class KriteriaKemungkinanController extends Controller
{
    public function storeKriteriaKemungkinan(Request $request)
    {
        $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'id_level_kemungkinan' => 'required|exists:level_kemungkinan,id',
            'presentase_kemungkinan' => 'required|string|max:255',
            'jumlah_frekuensi' => 'required|string|max:255',
        ]);

        KriteriaKemungkinan::create([
            'id_kategori_resiko' => $request->id_kategori_resiko,
            'id_level_kemungkinan' => $request->id_level_kemungkinan,
            'presentase_kemungkinan' => $request->presentase_kemungkinan,
            'jumlah_frekuensi' => $request->jumlah_frekuensi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Kemungkinan created successfully.');
    }

    public function updateKriteriaKemungkinan(Request $request, $id)
    {
        $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'id_level_kemungkinan' => 'required|exists:level_kemungkinan,id',
            'presentase_kemungkinan' => 'required|string|max:255',
            'jumlah_frekuensi' => 'required|string|max:255',
        ]);

        $kriteriaKemungkinan = KriteriaKemungkinan::findOrFail($id);
        $kriteriaKemungkinan->update([
            'id_kategori_resiko' => $request->id_kategori_resiko,
            'id_level_kemungkinan' => $request->id_level_kemungkinan,
            'presentase_kemungkinan' => $request->presentase_kemungkinan,
            'jumlah_frekuensi' => $request->jumlah_frekuensi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Kemungkinan updated successfully.');
    }

    public function destroyKriteriaKemungkinan($id)
    {
        $kriteriaKemungkinan = KriteriaKemungkinan::findOrFail($id);
        $kriteriaKemungkinan->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Kemungkinan deleted successfully.');
    }
}
