<?php

namespace App\Http\Controllers\Context;
use App\Models\SumberResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SumberResikoController extends Controller
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
            'kode' => 'required|string|max:255',
            'sumber_resiko' => 'required|string|max:255',
        ]);

        // Menyimpan data ke dalam tabel sumber_resiko
        SumberResiko::create([
            'kode' => $request->kode,
            'sumber_resiko' => $request->sumber_resiko,
        ]);

        // Redirect ke rute context dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Sumber Resiko created successfully.');
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
        // Validasi data yang diterima dari request
        $request->validate([
            'kode' => 'required|string|max:255',
            'sumber_resiko' => 'required|string|max:255',
        ]);

        // Mencari data berdasarkan ID dan memperbaruinya
        $sumberResiko = SumberResiko::findOrFail($id);
        $sumberResiko->update([
            'kode' => $request->kode,
            'sumber_resiko' => $request->sumber_resiko,
        ]);

        // Redirect ke rute context dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Sumber Resiko updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkan ID dan menghapusnya
        $sumberResiko = SumberResiko::findOrFail($id);
        $sumberResiko->delete();

        // Redirect ke rute context dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Sumber Resiko deleted successfully.');

    }
}
