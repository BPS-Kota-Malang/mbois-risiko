<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\LevelResiko;
use Illuminate\Http\Request;

class LevelResikoController extends Controller
{
    public function storeLevelResiko(Request $request)
    {
        $request->validate([
            'level_resiko' => 'required|string|max:255',
            'besaran_min' => 'required|integer|max:20',
            'besaran_max' => 'required|integer|max:20',
            'tindakan' => 'required|string|max:255',
            'ket_warna' => 'required|string|max:255',
        ]);

        LevelResiko::create([
            'level_resiko' => $request->level_resiko,
            'besaran_min' => $request->besaran_min,
            'besaran_max' => $request->besaran_max,
            'tindakan' => $request->tindakan,
            'ket_warna' => $request->ket_warna,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Resiko created successfully.');
    }

    public function updateLevelResiko(Request $request, $id)
    {
        $request->validate([
            'level_resiko' => 'required|string|max:255',
            'besaran_min' => 'required|integer|max:20',
            'besaran_max' => 'required|integer|max:20',
            'tindakan' => 'required|string|max:255',
            'ket_warna' => 'required|string|max:255',
        ]);

        $levelResiko = LevelResiko::find($id);

        if (!$levelResiko) {
            return redirect()->back()->withErrors('Level Resiko tidak ditemukan.');
        }

        $levelResiko->update([
            'level_resiko' => $request->level_resiko,
            'besaran_min' => $request->besaran_min,
            'besaran_max' => $request->besaran_max,
            'tindakan' => $request->tindakan,
            'ket_warna' => $request->ket_warna,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Resiko updated successfully.');
    }

    public function destroyLevelResiko($id)
    {
        $levelResiko = LevelResiko::find($id);

        if (!$levelResiko) {
            return redirect()->back()->withErrors('Level Resiko tidak ditemukan.');
        }

        $levelResiko->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Level Resiko deleted successfully.');
    }
}
