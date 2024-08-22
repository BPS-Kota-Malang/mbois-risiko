<?php

namespace App\Http\Controllers\Context;
use App\Models\SeleraResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeleraResikoController extends Controller
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
        // dd($request->all());
        $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'resiko_minimum_negatif' => 'required|integer|max:255',
            'resiko_minimum_positif' => 'required|integer|max:255',
        ]);

        // Simpan data baru ke dalam database
        SeleraResiko::create([
            'id_kategori_resiko' => $request->id_kategori_resiko,
            'resiko_minimum_negatif' => $request->resiko_minimum_negatif,
            'resiko_minimum_positif' => $request->resiko_minimum_positif,
        ]);
        return redirect()->route('admin.risk.context')->with('success', 'Selera Resiko berhasil ditambahkan.');
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
            'resiko_minimum_negatif' => 'required|integer|max:255',
            'resiko_minimum_positif' => 'required|integer|max:255',
        ]);

        // Cari data yang ingin diupdate
        $seleraResiko = SeleraResiko::findOrFail($id);
        $seleraResiko->update([
        'id_kategori_resiko' => $request->id_kategori_resiko,
        'resiko_minimum_negatif' => $request->resiko_minimum_negatif,
        'resiko_minimum_positif' => $request->resiko_minimum_positif,
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Selera Resiko berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seleraResiko = SeleraResiko::findOrFail($id);

        // Hapus data
        $seleraResiko->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Selera Resiko berhasil dihapus.');
    }
}
