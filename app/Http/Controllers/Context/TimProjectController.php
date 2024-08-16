<?php

namespace App\Http\Controllers\Context;

use App\Http\Controllers\Controller;
use App\Models\TimProject;
use Illuminate\Http\Request;

class TimProjectController extends Controller
{
    public function index()
    {
        $timProjects = TimProject::all();
        return response()->json($timProjects);
    }

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

    public function show($id)
    {
        $timProject = TimProject::findOrFail($id);
        return response()->json($timProject);
    }

    public function update(Request $request, $id)
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

    public function destroy($id)
    {
        $timProject = TimProject::findOrFail($id);
        $timProject->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Tim Project deleted successfully.');
    }
}
