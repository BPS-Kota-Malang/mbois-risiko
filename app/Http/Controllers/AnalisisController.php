<?php

namespace App\Http\Controllers;



use App\Models\ProsesBisnis;
use App\Models\TimProject;
use App\Models\ManajemenResiko;
use App\Models\Resiko;
use App\Models\JenisResiko;
use App\Models\SumberResiko;
use App\Models\KategoriResiko;
use App\Models\AreaDampak;
use App\Models\Penyebab;
use App\Models\Dampak;
use App\Models\Uraian;
use App\Models\LevelKemungkinan;
use App\Models\LevelResiko;
use App\Models\LevelDampak;
use App\Models\MatriksAnalisisResiko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AnalisisController extends Controller
{

    public function index(Request $request)
    {
        $tim = $request->input('tim');
        $prosesBisnis = $request->input('proses_bisnis');
        $resiko = Resiko::all();
        $jenisResiko = JenisResiko::all();
        $sumberResiko = SumberResiko::all();
        $kategoriResiko = KategoriResiko::all();
        $areaDampak = AreaDampak::all();
        $timProjects = TimProject::all();
        $penyebab = Penyebab::all();
        $dampak = Dampak::all();
        $ProsesBisnis = ProsesBisnis::all();
        $manajemenResiko = ManajemenResiko::all();
        $levelKemungkinan = LevelKemungkinan::all();
        $levelResiko = LevelResiko::all();
        $levelDampak = LevelDampak::all();
        $uraian = Uraian::all();
        $matriksAnalisisResiko = MatriksAnalisisResiko::all();
        $query = ManajemenResiko::query();

        if ($tim) {
            $query->where('id_tim_project', $tim);
        }

        if ($prosesBisnis) {
            $query->where('id_proses_bisnis', $prosesBisnis);
        }
        $ManajemenResiko = $query->with(['prosesBisnis', 'tim_project', 'resiko', 'matriksAnalisisResiko'])->get();
        return view('admin.risk.analysis', compact(
            'jenisResiko',
            'penyebab',
            'sumberResiko',
            'kategoriResiko',
            'areaDampak',
            'timProjects',
            'dampak',
            'resiko',
            'ProsesBisnis',
            'ManajemenResiko',
            'levelKemungkinan',
            'levelResiko',
            'levelDampak',
            'uraian',
            'matriksAnalisisResiko',
        ));
    }

    public function create()
    {
        //
    }

    public function saveUraian(Request $request)
    {
        $validated = $request->validate([
            'uraian' => 'required|array',
            'uraian.*' => 'required|string|max:255',
            'manajemen_resiko_id' => 'required|exists:manajemen_resiko,id',
        ]);

        $manajemenResiko = ManajemenResiko::find($validated['manajemen_resiko_id']);

        if (!$manajemenResiko) {
            return response()->json(['success' => false, 'message' => 'Manajemen Resiko tidak ditemukan.'], 404);
        }
        $manajemenResiko->id_uraian = json_encode($validated['uraian']);
        $manajemenResiko->save();

        return response()->json(['success' => true, 'message' => 'Uraian berhasil disimpan.']);
    }

    public function hapusUraian($id, $uraian)
    {
        $dataUraian = Uraian::all();
        $manajemenResiko = ManajemenResiko::find($id);
        $Jsonuraian = json_decode($manajemenResiko->id_uraian);
        $id_uraian = array_diff($Jsonuraian, [$uraian]);
        $id_uraian = array_values($id_uraian);
        $id_uraian = json_encode($id_uraian);
        $manajemenResiko->id_uraian = $id_uraian;
        $manajemenResiko->save();

        //response route
        return redirect()->route('admin.analisis.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        // dd($request->input('efektivitas'));
        Log::info('Update request data:', $request->all());
        $manajemenResiko = ManajemenResiko::findOrFail($id);
        Log::info('Found ManajemenResiko record:', $manajemenResiko->toArray());
        $manajemenResiko->id_level_kemungkinan = (int) $request->input('level_kemungkinan')[0];
        $manajemenResiko->id_level_dampak = (int) $request->input('level_dampak')[0];
        $calculatedRiskLevel = $this->calculateRiskLevel($request->input('level_kemungkinan'), $request->input('level_dampak'));
        Log::info('Calculated Risk Level:', ['risk_level' => $calculatedRiskLevel]);
        $manajemenResiko->id_matriks_analisis_resiko = $calculatedRiskLevel;
        $manajemenResiko->efektivitas = ucfirst($request->input('efektivitas'));
        $manajemenResiko->save();
        Log::info('Updated ManajemenResiko record:', $manajemenResiko->toArray());
        return redirect()->route('admin.analisis.index')->with('success', 'Data successfully updated');
    }

    private function calculateRiskLevel($levelKemungkinan, $levelDampak)
    {
        $riskMatrix = MatriksAnalisisResiko::where('id_level_kemungkinan', $levelKemungkinan)
            ->where('id_level_dampak', $levelDampak)
            ->first();

        // Return the id of the risk matrix
        return $riskMatrix ? $riskMatrix->id : null;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}