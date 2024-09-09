<?php

namespace App\Http\Controllers;

use App\Models\AnalisisResiko;
use App\Models\ProsesBisnis;
use App\Models\TimProject;
use App\Models\ManajemenResiko;
use App\Models\LevelKemungkinan;
use App\Models\LevelResiko;
use App\Models\LevelDampak;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timProjects = TimProject::all();
        $prosesBisnis = ProsesBisnis::all();
        $manajemenResikos = ManajemenResiko::all();
        $levelKemungkinans = LevelKemungkinan::all();
        $levelResikos = LevelResiko::all();
        $levelDampaks = LevelDampak::all();
        return view('admin.risk.analysis', compact('timProjects', 'prosesBisnis','manajemenResikos','levelKemungkinans','levelResikos','levelDampaks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Provide data needed for creating a new resource if applicable
        $timProjects = TimProject::all();
        $prosesBisnis = ProsesBisnis::all();
        $levelKemungkinans = LevelKemungkinan::all();
        $levelResikos = LevelResiko::all();
        $levelDampaks = LevelDampak::all();

        return view('admin.risk.create', compact('timProjects', 'prosesBisnis', 'levelKemungkinans', 'levelResikos', 'levelDampaks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'tim_project_id' => 'required|exists:tim_projects,id',
            'proses_bisnis_id' => 'required|exists:proses_bisnis,id',
            'manajemen_resiko_id' => 'required|exists:manajemen_resikos,id',
            'level_kemungkinan_id' => 'required|exists:level_kemungkinans,id',
            'level_resiko_id' => 'required|exists:level_resikos,id',
            'level_dampak_id' => 'required|exists:level_dampaks,id',
        ]);

        // Create new resource
        $analisis = new AnalisisResiko();
        $analisis->tim_project_id = $request->tim_project_id;
        $analisis->proses_bisnis_id = $request->proses_bisnis_id;
        $analisis->manajemen_resiko_id = $request->manajemen_resiko_id;
        $analisis->level_kemungkinan_id = $request->level_kemungkinan_id;
        $analisis->level_resiko_id = $request->level_resiko_id;
        $analisis->level_dampak_id = $request->level_dampak_id;
        $analisis->save();

        return redirect()->route('admin.analisis.index')->with('success', 'Analisis berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find resource by ID
        $analisis = AnalisisResiko::findOrFail($id);
        return view('admin.risk.show', compact('analisis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find resource by ID
        $analisis = AnalisisResiko::findOrFail($id);
        $timProjects = TimProject::all();
        $prosesBisnis = ProsesBisnis::all();
        $levelKemungkinans = LevelKemungkinan::all();
        $levelResikos = LevelResiko::all();
        $levelDampaks = LevelDampak::all();

        return view('admin.risk.edit', compact('analisis', 'timProjects', 'prosesBisnis', 'levelKemungkinans', 'levelResikos', 'levelDampaks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            // 'manajemen_resiko_id' => 'required|exists:manajemen_resikos,id',
            'level_kemungkinan_id' => 'required',
            'level_resiko_id' => 'required',
            'level_dampak_id' => 'required',
        ]);

        // Find and update resource
        $analisis = ManajemenResiko::findOrFail($id);
        // $analisis->manajemen_resiko_id = $request->manajemen_resiko_id;
        $analisis->id_level_kemungkinan = $request->level_kemungkinan_id;
        $analisis->id_level_resiko = $request->level_resiko_id;
        $analisis->id_level_dampak = $request->level_dampak_id;
        $analisis->efektivitas = $request->efektivitas;
        $analisis->save();

        return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete resource
        $analisis = AnalisisResiko::findOrFail($id);
        $analisis->delete();

        return redirect()->route('admin.analisis.index')->with('success', 'Analisis berhasil dihapus.');
    }
}