<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\MatriksAnalisisResiko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MatriksAnalisisResikoController extends Controller
{
    public function storeMatriksAnalisisResiko(Request $request)
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

    public function updateMatriksAnalisisResiko(Request $request, $id)
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

    public function destroyMatriksAnalisisResiko($id)
    {
        $matriksAnalisisResiko = MatriksAnalisisResiko::findOrFail($id);
        $matriksAnalisisResiko->delete();
        return redirect()->route('admin.risk.context')->with('success', 'Matriks Analisis Resiko deleted successfully.');
    }
}