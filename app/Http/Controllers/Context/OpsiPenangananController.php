<?php

namespace App\Http\Controllers\Context;
use App\Http\Controllers\Controller;
use App\Models\OpsiPenanganan;
use Illuminate\Http\Request;

class OpsiPenangananController extends Controller
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
            'name'=> 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'id_jenis_resiko' => 'required|exists:jenis_resiko,id', // Perbaiki validasi exists
        ]);

        OpsiPenanganan::create([
            'name' => $request->name, // Pastikan menggunakan $request->name
            'deskripsi' => $request->deskripsi,
            'id_jenis_resiko' => $request->id_jenis_resiko,
        ]);
        return redirect()->route('admin.risk.context')->with('success', 'Opsi Penanganan berhasil ditambahkan.');
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
            'name'=> 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'id_jenis_resiko' => 'required|exists:jenis_resiko,id', // Perbaiki validasi exists
        ]);

        $opsiPenanganan = OpsiPenanganan::findOrFail($id);
        $opsiPenanganan->update([
            'name' => $request->name, // Pastikan menggunakan $request->name
            'deskripsi' => $request->deskripsi,
            'id_jenis_resiko' => $request->id_jenis_resiko,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Opsi Penanganan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $opsiPenanganan = OpsiPenanganan::findOrFail($id);
        $opsiPenanganan->delete();


        return redirect()->route('admin.risk.context')->with('success', 'Peraturan Perundang Undangan deleted successfully.');
    }
}
