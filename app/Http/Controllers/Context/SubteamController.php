<?php

namespace App\Http\Controllers\Context;
use App\Models\Subteam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubteamController extends Controller
{

    public function index()
    {
        $subteams = Subteam::all();
        return response()->json($subteams);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subteam = Subteam::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.risk.context');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subteam = Subteam::findOrFail($id);
        return response()->json($subteam);

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
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $subteams = Subteam::findOrFail($id);
        $subteams->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Tim project updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subteams = Subteam::findOrFail($id);
        $subteams->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Tim Project deleted successfully.');

    }

    public function getsubteams ($team_id)
    {
        $subteams = Subteam::where('tim_project_id', $team_id)->get();

        // Return the response as JSON
        return response()->json($subteams);
    }
}
