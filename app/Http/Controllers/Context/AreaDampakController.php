<?php

namespace App\Http\Controllers\Context;
use App\Models\AreaDampak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreaDampakController extends Controller
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
            'area_dampak' => 'required|string|max:255',
        ]);

        AreaDampak::create([
            'area_dampak' => $request->area_dampak,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Area Dampak created successfully.');

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
            'area_dampak' => 'required|string|max:255',
        ]);

        $areaDampak = AreaDampak::findOrFail($id);
        $areaDampak->update([
            'area_dampak' => $request->area_dampak,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Area Dampak updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $areaDampak = AreaDampak::findOrFail($id);
        $areaDampak->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Area Dampak deleted successfully.');
    }
}
