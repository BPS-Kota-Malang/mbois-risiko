<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\SumberResiko;
use Illuminate\Http\Request;

class SumberResikoController extends Controller
{
    // Menyimpan data Sumber Resiko baru
    public function storeSumberResiko(Request $request)
    {
        // Validasi data yang diterima dari request
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

    // Memperbarui data Sumber Resiko yang sudah ada
    public function updateSumberResiko(Request $request, $id)
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

    // Menghapus data Sumber Resiko
    public function destroySumberResiko($id)
    {
        // Mencari data berdasarkan ID dan menghapusnya
        $sumberResiko = SumberResiko::findOrFail($id);
        $sumberResiko->delete();

        // Redirect ke rute context dengan pesan sukses
        return redirect()->route('admin.risk.context')->with('success', 'Sumber Resiko deleted successfully.');
    }
}
