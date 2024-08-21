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
        $validatedData = $request->validate([
            'id_kategori_resiko' => 'required|integer',
            'resiko_minimum_negatif' => 'required|integer',
            'resiko_minimum_positif' => 'required|integer',
        ]);

        // Simpan data baru ke dalam database
        SeleraResiko::create($validatedData);

        // Redirect dengan pesan sukses
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
        $validatedData = $request->validate([
            'id_kategori_resiko' => 'required|integer',
            'resiko_minimum_negatif' => 'required|integer',
            'resiko_minimum_positif' => 'required|integer',
        ]);

        // Cari data yang ingin diupdate
        $seleraResiko = SeleraResiko::findOrFail($id);

        // Update data dengan input baru
        $seleraResiko->update($validatedData);

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
