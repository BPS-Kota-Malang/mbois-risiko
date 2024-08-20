<?php

namespace App\Http\Controllers\Context;
use App\Models\KriteriaKemungkinan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KriteriaKemungkinanController extends Controller
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kriteriaKemungkinan = KriteriaKemungkinan::findOrFail($id);
        $kriteriaKemungkinan->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Kriteria Kemungkinan deleted successfully.');

    }
}
