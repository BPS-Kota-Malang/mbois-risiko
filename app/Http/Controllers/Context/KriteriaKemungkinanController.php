<?php

namespace App\Http\Controllers\Context;

use App\Models\KriteriaKemungkinan;
use App\Models\KategoriResiko;
use App\Models\LevelKemungkinan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KriteriaKemungkinanController extends Controller
{
    public function index()
    {
        $kriteriaKemungkinan = KriteriaKemungkinan::with(['kategoriResiko', 'levelKemungkinan'])->get();
        $kategoriResiko = KategoriResiko::all();
        $levelKemungkinan = LevelKemungkinan::all();

        return view('kriteria_kemungkinan.index', compact('kriteriaKemungkinan', 'kategoriResiko', 'levelKemungkinan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'id_level_kemungkinan' => 'required|exists:level_kemungkinan,id',
            'presentase_kemungkinan' => 'required|numeric',
            'jumlah_frekuensi' => 'required|numeric',
        ]);

        $kriteriaKemungkinan = KriteriaKemungkinan::create($validated);

        // Prepare response data for DataTables
        $response = [
            'no' => $kriteriaKemungkinan->id,
            'kategori_resiko' => $kriteriaKemungkinan->kategoriResiko->deskripsi,
            'level_kemungkinan' => $kriteriaKemungkinan->levelKemungkinan->level_kemungkinan,
            'presentase_kemungkinan' => $kriteriaKemungkinan->presentase_kemungkinan,
            'jumlah_frekuensi' => $kriteriaKemungkinan->jumlah_frekuensi,
            'edit_url' => route('admin.kriteriakemungkinan.update', $kriteriaKemungkinan->id),
            'delete_url' => route('admin.kriteriakemungkinan.destroy', $kriteriaKemungkinan->id),
            'csrf_token' => csrf_token(),
        ];

        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'id_level_kemungkinan' => 'required|exists:level_kemungkinan,id',
            'presentase_kemungkinan' => 'required|numeric',
            'jumlah_frekuensi' => 'required|numeric',
        ]);

        $kriteriaKemungkinan = KriteriaKemungkinan::findOrFail($id);
        $kriteriaKemungkinan->update($validated);

        // Prepare response data for DataTables
        $response = [
            'no' => $kriteriaKemungkinan->id,
            'kategori_resiko' => $kriteriaKemungkinan->kategoriResiko->deskripsi,
            'level_kemungkinan' => $kriteriaKemungkinan->levelKemungkinan->level_kemungkinan,
            'presentase_kemungkinan' => $kriteriaKemungkinan->presentase_kemungkinan,
            'jumlah_frekuensi' => $kriteriaKemungkinan->jumlah_frekuensi,
            'edit_url' => route('admin.kriteriakemungkinan.update', $kriteriaKemungkinan->id),
            'delete_url' => route('admin.kriteriakemungkinan.destroy', $kriteriaKemungkinan->id),
            'csrf_token' => csrf_token(),
        ];

        return response()->json($response);
    }

    public function destroy($id)
    {
        $kriteriaKemungkinan = KriteriaKemungkinan::findOrFail($id);
        $kriteriaKemungkinan->delete();

        return response()->json(['success' => 'Kriteria Kemungkinan deleted successfully.']);
    }
}