<?php

namespace App\Http\Controllers;
use App\Models\JenisResiko; // Pastikan model ini ada
use App\Models\SumberResiko; // Pastikan model ini ada
use App\Models\KategoriResiko; // Pastikan model ini ada
use App\Models\AreaDampak; // Pastikan model ini ada
use App\Models\Penyebab; // Pastikan model ini ada
use Illuminate\Http\Request;

class IdentificationController extends Controller
{
    public function showIdentification()
    {
        $jenisResiko = JenisResiko::all();
        $SumberResiko = SumberResiko::all(); // Ensure this variable is defined
        $kategoriResiko = KategoriResiko::all();
        $areaDampak = AreaDampak::all(); // Ensure this model is imported
        dd($jenisResiko, $SumberResiko, $kategoriResiko, $areaDampak);
        return view('admin.risk.identification', compact('jenisResiko', 'SumberResiko', 'kategoriResiko', 'areaDampak'));
    }

    public function savePenyebab(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'penyebab' => 'required|string|max:255',
            'status' => 'nullable|string|max:255', // Validasi kolom status bisa kosong
        ]);


        // Simpan data ke database
        Penyebab::create($validatedData);

        // Kembalikan respons
        return response()->json(['message' => 'Data berhasil disimpan']);
    }

}
