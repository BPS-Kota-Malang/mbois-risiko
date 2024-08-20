<?php

namespace App\Http\Controllers\Context;
use App\Models\LevelDampak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelDampakController extends Controller
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
            'level_dampak' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        LevelDampak::create([
            'level_dampak' => $request->level_dampak,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Dampak created successfully.');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $levelDampak = LevelDampak::findOrFail($id);
        $levelDampak->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Level Dampak deleted successfully.');
    }
}
