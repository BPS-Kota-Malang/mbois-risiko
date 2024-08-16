<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\JenisResiko;
use Illuminate\Http\Request;

class JenisResikoController extends Controller
{

    public function storeJenisResiko(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'jenis_resiko' => 'required|string|max:255',
        ]);

        JenisResiko::create([
            'kode' => $request->kode,
            'jenis_resiko' => $request->jenis_resiko,
        ]);

        return redirect()->route('admin.risk.context');
    }

    public function updateJenisResiko(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'jenis_resiko' => 'required|string|max:255',
        ]);

        $jenisResiko = JenisResiko::findOrFail($id);
        $jenisResiko->update([
            'kode' => $request->kode,
            'jenis_resiko' => $request->jenis_resiko,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Jenis Resiko updated successfully.');
    }

    public function destroyJenisResiko($id)
    {
        $jenisResiko = JenisResiko::findOrFail($id);
        $jenisResiko->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Jenis Resiko deleted successfully.');
    }
}
