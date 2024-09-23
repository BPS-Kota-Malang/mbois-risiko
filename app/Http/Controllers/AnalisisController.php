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
        $resiko = Resiko::all() ?? collect();
        $jenisResiko = JenisResiko::all() ?? collect();
        $sumberResiko = SumberResiko::all() ?? collect();
        $kategoriResiko = KategoriResiko::all() ?? collect();
        $areaDampak = AreaDampak::all() ?? collect();
        $timProjects = TimProject::all() ?? collect();
        $penyebab = Penyebab::all() ?? collect();
        $dampak = Dampak::all() ?? collect();
        $ProsesBisnis = ProsesBisnis::all() ?? collect();
        $manajemenResiko = ManajemenResiko::all() ?? collect();
        $levelKemungkinan = LevelKemungkinan::all() ?? collect();
        $levelResiko = LevelResiko::all() ?? collect();
        $levelDampak = LevelDampak::all() ?? collect();
        $uraian = Uraian::all() ?? collect();
        $matriksAnalisisResiko = MatriksAnalisisResiko::all() ?? collect();
        $query = ManajemenResiko::query();

        if ($tim) {
            $query->where('id_tim_project', $tim);
        }

        if ($prosesBisnis) {
            $query->where('id_proses_bisnis', $prosesBisnis);
        }

        // Use paginate method on the query builder instance
        $ManajemenResiko = $query->with(['prosesBisnis', 'tim_project', 'resiko', 'matriksAnalisisResiko'])->paginate(10);

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
            'matriksAnalisisResiko'
        ));
    }

    public function create()
    {
        //
    }

    public function saveUraian(Request $request)
    {
        $request->validate([
            'uraian' => 'required|array',
            'manajemen_resiko_id' => 'required|exists:manajemen_resiko,id',
        ]);

        $manajemenResiko = ManajemenResiko::find($request->manajemen_resiko_id);
        if (!$manajemenResiko) {
            return response()->json(['success' => false, 'message' => 'Manajemen Resiko tidak ditemukan.'], 404);
        }

        // Simpan ID uraian yang dipilih dalam format JSON
        $manajemenResiko->id_uraian = json_encode($request->uraian);
        $manajemenResiko->save();

        return response()->json(['success' => true, 'message' => 'Uraian berhasil disimpan.']);
    }

    public function hapusUraian($id, $uraian)
    {
        $manajemenResiko = ManajemenResiko::find($id);

        if (!$manajemenResiko) {
            return redirect()->route('admin.analisis.index')->with('error', 'Manajemen Resiko tidak ditemukan.');
        }

        // Ambil data uraian yang sudah ada
        $JsonUraian = json_decode($manajemenResiko->id_uraian, true);

        if (!is_array($JsonUraian)) {
            return redirect()->route('admin.analisis.index')->with('error', 'Data uraian tidak valid.');
        }

        // Hapus data uraian yang dipilih
        $id_uraian = array_diff($JsonUraian, [$uraian]);

        // Ubah key array
        $id_uraian = array_values($id_uraian);

        $id_uraian = json_encode($id_uraian);

        // Simpan kembali ke database
        $manajemenResiko->id_uraian = $id_uraian;
        $manajemenResiko->save();

        // Response route
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


        $manajemenResikoIds = $request->input('manajemen_resiko_ids', []);
        $levelKemungkinan = $request->input('level_kemungkinan', []);
        $levelDampak = $request->input('level_dampak', []);
        $efektivitas = $request->input('efektivitas', []);

        $calculatedRiskLevel = $this->calculateRiskLevel($levelKemungkinan, $levelDampak);

        foreach ($manajemenResikoIds as $index => $id) {
            $manajemenResiko = ManajemenResiko::find($id);

            if ($manajemenResiko) {
            // Update existing record
            $manajemenResiko->id_level_kemungkinan = $levelKemungkinan[$index] ?? $manajemenResiko->id_level_kemungkinan;
            $manajemenResiko->id_level_dampak = $levelDampak[$index] ?? $manajemenResiko->id_level_dampak;
            $manajemenResiko->id_matriks_analisis_resiko = $calculatedRiskLevel;
            $manajemenResiko->efektivitas = $efektivitas[$index] ?? $manajemenResiko->efektivitas;
            $manajemenResiko->save();
            } else {
            // Create new record
            ManajemenResiko::create([
                'id_level_kemungkinan' => $levelKemungkinan[$index] ?? null,
                'id_level_dampak' => $levelDampak[$index] ?? null,
                'id_matriks_analisis_resiko' => $calculatedRiskLevel,
                'efektivitas' => $efektivitas[$index] ?? null,
                // Tambahkan field lain yang diperlukan
            ]);
            }
        }

        return redirect()->route('admin.analisis.index')->with('success', 'Data berhasil disimpan.');
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
