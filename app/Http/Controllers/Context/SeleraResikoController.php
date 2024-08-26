<?php

namespace App\Http\Controllers\Context;
use App\Models\SeleraResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeleraResikoController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'resiko_minimum_negatif' => 'required|integer|max:255',
            'resiko_minimum_positif' => 'required|integer|max:255',
        ]);

        SeleraResiko::create([
            'id_kategori_resiko' => $request->id_kategori_resiko,
            'resiko_minimum_negatif' => $request->resiko_minimum_negatif,
            'resiko_minimum_positif' => $request->resiko_minimum_positif,
        ]);
        return redirect()->route('admin.risk.context')->with('success', 'Selera Resiko berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kategori_resiko' => 'required|exists:kategori_resiko,id',
            'resiko_minimum_negatif' => 'required|integer|max:255',
            'resiko_minimum_positif' => 'required|integer|max:255',
        ]);

        $seleraResiko = SeleraResiko::findOrFail($id);
        $seleraResiko->update([
        'id_kategori_resiko' => $request->id_kategori_resiko,
        'resiko_minimum_negatif' => $request->resiko_minimum_negatif,
        'resiko_minimum_positif' => $request->resiko_minimum_positif,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Selera Resiko berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $seleraResiko = SeleraResiko::findOrFail($id);
        $seleraResiko->delete();


        return redirect()->route('admin.risk.context')->with('success', 'Selera Resiko berhasil dihapus.');
    }
}
