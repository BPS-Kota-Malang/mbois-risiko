<?php

namespace App\Http\Controllers\Context;
use App\Models\TimProject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timProjects = TimProject::all();
        return response()->json($timProjects);
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
            'nama_team' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $timProject = TimProject::create([
            'nama_team' => $request->nama_team,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.risk.context');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timProject = TimProject::findOrFail($id);
        return response()->json($timProject);

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
            'nama_team' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $timProject = TimProject::findOrFail($id);
        $timProject->update([
            'nama_team' => $request->nama_team,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Tim project updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timProject = TimProject::findOrFail($id);
        $timProject->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Tim Project deleted successfully.');

    }
}
