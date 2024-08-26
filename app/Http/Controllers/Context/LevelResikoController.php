<?php

namespace App\Http\Controllers\Context;
use App\Models\LevelResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelResikoController extends Controller
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
        $request->validate([
            'level_resiko' => 'required|string|max:255',
            'besaran_min' => 'required|integer|max:255',
            'besaran_max' => 'required|integer|max:255',
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
        $request->validate([
            'level_resiko' => 'required|string|max:255',
            'besaran_min' => 'required|integer|max:255',
            'besaran_max' => 'required|integer|max:255',
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

        return redirect()->route('risk.context.index')->with('success', 'Level Resiko updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $levelResiko = LevelResiko::find($id);

        if (!$levelResiko) {
            return redirect()->back()->withErrors('Level Resiko tidak ditemukan.');
        }

        $levelResiko->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Level Resiko deleted successfully.');
    }
}
