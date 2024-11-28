<?php

namespace App\Http\Controllers\Context;
use App\Models\PeraturanPerundangUndangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeraturanPerundangUndanganController extends Controller
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
            'peraturan_perundang_undangan' => 'required|string|max:255',
            'amanat' => 'nullable|string|max:255',
        ]);

        PeraturanPerundangUndangan::create([
            'peraturan_perundang_undangan' => $request->peraturan_perundang_undangan,
            'amanat' => $request->amanat,
        ]);

        return redirect()->route('admin.risk.context');
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
            'peraturan_perundang_undangan' => 'required|string|max:255',
            'amanat' => 'nullable|string|max:255',
        ]);

        $peraturanPerundangUndangan = PeraturanPerundangUndangan::findOrFail($id);
        $peraturanPerundangUndangan->update([
            'peraturan_perundang_undangan' => $request->peraturan_perundang_undangan,
            'amanat' => $request->amanat,
        ]);
        return redirect()->route('admin.risk.context');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peraturanPerundangUndangan = PeraturanPerundangUndangan::findOrFail($id);
        $peraturanPerundangUndangan->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Peraturan Perundang Undangan deleted successfully.');
    }
}
