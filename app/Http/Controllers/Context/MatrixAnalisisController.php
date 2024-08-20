<?php

namespace App\Http\Controllers\Context;
use App\Models\MatriksAnalisisResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatrixAnalisisResikoController extends Controller
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
        dd($request->all());
        $request->validate([
            'id_level_kemungkinan' => 'required|integer|exists:level_kemungkinan,id',
            'id_level_dampak' => 'required|integer|exists:level_dampak,id',
            'besaran_resiko' => 'required|string|max:255',
            'id_level_resiko' => 'required|string|max:255',
        ]);
        MatriksAnalisisResiko::create([
            'id_level_kemungkinan' => $request->id_level_kemungkinan,
            'id_level_dampak' => $request->id_level_dampak,
            'besaran_resiko' => $request->besaran_resiko,
            'id_level_resiko' => $request->id_level_resiko,
        ]);
        return redirect()->route('admin.risk.context')->with('success', 'Matriks Analisis Resiko created successfully.');
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
        // dd($request->all());
        $request->validate([
            'id_level_kemungkinan' => 'required|integer|exists:level_kemungkinan,id',
            'id_level_dampak' => 'required|integer|exists:level_dampak,id',
            'besaran_resiko' => 'required|string|max:255',
            'id_level_resiko' => 'required|string|max:255',
        ]);
        $matriksAnalisisResiko = MatriksAnalisisResiko::findOrFail($id);
        $matriksAnalisisResiko->update([
            'id_level_kemungkinan' => $request->id_level_kemungkinan,
            'id_level_dampak' => $request->id_level_dampak,
            'besaran_resiko' => $request->besaran_resiko,
            'id_level_resiko' => $request->id_level_resiko,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Matriks Analisis Resiko updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $matriksAnalisisResiko = MatriksAnalisisResiko::findOrFail($id);
        $matriksAnalisisResiko->delete();
        return redirect()->route('admin.risk.context')->with('success', 'Matriks Analisis Resiko deleted successfully.');

    }
}
