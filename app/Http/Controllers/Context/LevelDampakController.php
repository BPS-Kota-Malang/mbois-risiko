<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\LevelDampak;
use Illuminate\Http\Request;

class LevelDampakController extends Controller
{
    public function storeLevelDampak(Request $request)
    {
        $request->validate([
            'level_dampak' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        LevelDampak::create([
            'level_dampak' => $request->level_dampak,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Dampak created successfully.');
    }

    public function updateLevelDampak(Request $request, $id)
    {
        $request->validate([
            'level_dampak' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        $levelDampak = LevelDampak::findOrFail($id);
        $levelDampak->update([
            'level_dampak' => $request->level_dampak,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Dampak updated successfully.');
    }

    public function destroyLevelDampak($id)
    {
        $levelDampak = LevelDampak::findOrFail($id);
        $levelDampak->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Level Dampak deleted successfully.');
    }
}
