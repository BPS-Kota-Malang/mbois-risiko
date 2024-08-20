<?php

namespace App\Http\Controllers\Context;
use App\Models\KategoriResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriResikoController extends Controller
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
            'deskripsi' => 'required|string|max:255',
            'definisi' => 'required|string|max:255',
        ]);

        KategoriResiko::create([
            'deskripsi' => $request->deskripsi,
            'definisi' => $request->definisi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Kategori Resiko created successfully.');
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
            'deskripsi' => 'required|string|max:255',
            'definisi' => 'required|string|max:255',
        ]);

        $kategoriResiko = KategoriResiko::findOrFail($id);
        $kategoriResiko->update([
            'deskripsi' => $request->deskripsi,
            'definisi' => $request->definisi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Kategori Resiko updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriResiko = KategoriResiko::findOrFail($id);
        $kategoriResiko->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Kategori Resiko deleted successfully.');
    }
}
