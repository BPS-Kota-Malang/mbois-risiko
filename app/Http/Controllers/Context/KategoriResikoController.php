<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\KategoriResiko;
use Illuminate\Http\Request;

class KategoriResikoController extends Controller
{
    public function storeKategoriResiko(Request $request)
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

    public function updateKategoriResiko(Request $request, $id)
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

    public function destroyKategoriResiko($id)
    {
        $kategoriResiko = KategoriResiko::findOrFail($id);
        $kategoriResiko->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Kategori Resiko deleted successfully.');
    }
}
