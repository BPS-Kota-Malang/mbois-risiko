<?php

namespace App\Http\Controllers\Context;
use App\Models\LevelKemungkinan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelKemungkinanController extends Controller
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
            'level_kemungkinan' => 'required|string|max:255',
        ]);

        LevelKemungkinan::create([
            'level_kemungkinan' => $request->level_kemungkinan,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Kemungkinan created successfully.');
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
            'level_kemungkinan' => 'required|string|max:255',
        ]);

        $levelKemungkinan = LevelKemungkinan::findOrFail($id);
        $levelKemungkinan->update([
            'level_kemungkinan' => $request->level_kemungkinan,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Level Kemungkinan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $levelKemungkinan = LevelKemungkinan::findOrFail($id);
        $levelKemungkinan->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Level Kemungkinan deleted successfully.');
    }
}
