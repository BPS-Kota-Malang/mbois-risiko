<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\AreaDampak;
use Illuminate\Http\Request;

class AreaDampakController extends Controller
{
    public function storeAreaDampak(Request $request)
    {
        $request->validate([
            'area_dampak' => 'required|string|max:255',
        ]);

        AreaDampak::create([
            'area_dampak' => $request->area_dampak,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Area Dampak created successfully.');
    }

    public function updateAreaDampak(Request $request, $id)
    {
        $request->validate([
            'area_dampak' => 'required|string|max:255',
        ]);

        $areaDampak = AreaDampak::findOrFail($id);
        $areaDampak->update([
            'area_dampak' => $request->area_dampak,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Area Dampak updated successfully.');
    }

    public function destroyAreaDampak($id)
    {
        $areaDampak = AreaDampak::findOrFail($id);
        $areaDampak->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Area Dampak deleted successfully.');
    }
}
