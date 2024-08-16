<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\PeraturanPerundangUndangan;
use Illuminate\Http\Request;

class PeraturanPerundangUndanganController extends Controller
{
    public function storePeraturan(Request $request)
    {
        $request->validate([
            'peraturan_perundang_undangan' => 'required|string|max:255',
            'amanat' => 'nullable|string|max:255',
        ]);

        PeraturanPerundangUndangan::create([
            'peraturan_perundang_undangan' => $request->peraturan_perundang_undangan,
            'amanat' => $request->amanat,
        ]);

        return redirect()->route('admin.risk.context');
    }

    public function updatePeraturan(Request $request, $id)
    {
        $request->validate([
            'peraturan_perundang_undangan' => 'required|string|max:255',
            'amanat' => 'nullable|string|max:255',
        ]);

        $peraturanPerundangUndangan = PeraturanPerundangUndangan::findOrFail($id);
        $peraturanPerundangUndangan->update([
            'peraturan_perundang_undangan' => $request->peraturan_perundang_undangan,
            'amanat' => $request->amanat,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Peraturan Perundang Undangan updated successfully.');
    }

    public function destroyPeraturan($id)
    {
        $peraturanPerundangUndangan = PeraturanPerundangUndangan::findOrFail($id);
        $peraturanPerundangUndangan->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Peraturan Perundang Undangan deleted successfully.');
    }
}
