<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\LevelKemungkinan;
use Illuminate\Http\Request;

class LevelKemungkinanController extends Controller
{
    public function storeLevelKemungkinan(Request $request)
    {
        $request->validate([
            'level_kemungkinan' => 'required|string|max:255',
        ]);

        LevelKemungkinan::create([
            'level_kemungkinan' => $request->level_kemungkinan,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Kemungkinan created successfully.');
    }

    public function updateLevelKemungkinan(Request $request, $id)
    {
        $request->validate([
            'level_kemungkinan' => 'required|string|max:255',
        ]);

        $levelKemungkinan = LevelKemungkinan::findOrFail($id);
        $levelKemungkinan->update([
            'level_kemungkinan' => $request->level_kemungkinan,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Kemungkinan updated successfully.');
    }

    public function destroyLevelKemungkinan($id)
    {
        $levelKemungkinan = LevelKemungkinan::findOrFail($id);
        $levelKemungkinan->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Level Kemungkinan deleted successfully.');
    }
}
