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
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\RencanaTindakPenanganan;


class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $dataPegawai = Pegawai::all() ?? collect();
        $rtp = RencanaTindakPenanganan::all() ?? collect();


        if ($tim) {
            $query->where('id_tim_project', $tim);
        }

        if ($prosesBisnis) {
            $query->where('id_proses_bisnis', $prosesBisnis);
        }

        $manajemenResikos = $query->with(['prosesBisnis', 'tim_project', 'resiko', 'matriksAnalisisResiko'])->paginate(10);

        return view('admin.risk.perencanaan', compact(
            'jenisResiko',
            'penyebab',
            'sumberResiko',
            'kategoriResiko',
            'areaDampak',
            'timProjects',
            'dampak',
            'resiko',
            'ProsesBisnis',
            'manajemenResikos',
            'levelKemungkinan',
            'levelResiko',
            'levelDampak',
            'uraian',
            'matriksAnalisisResiko',
            'dataPegawai',
            'rtp',
        ));
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
            'name' => 'required|string|max:255',
            'target_output' => 'required|string',
            'target_waktu' => 'required|date',
            'id_data_pegawai' => 'required|exists:data_pegawai,id',
            'id_level_kemungkinan' => 'required|exists:level_kemungkinan,id',
            'id_level_dampak' => 'required|exists:level_dampak,id',
            'id_matriks_analisis_resiko' => 'required|exists:matriks_analisis_resiko,id',
            'id_manajemen_resiko' => 'required|exists:manajemen_resiko,id',
        ]);

        DB::table('rencana_tindak_penanganan')->insert([
            'name' => $request->name,
            'target_output' => $request->target_output,
            'target_waktu' => $request->target_waktu,
            'id_data_pegawai' => $request->id_data_pegawai,
            'id_level_kemungkinan' => $request->id_level_kemungkinan,
            'id_level_dampak' => $request->id_level_dampak,
            'id_matriks_analisis_resiko' => $request->id_matriks_analisis_resiko,
            'id_manajemen_resiko' => $request->id_manajemen_resiko,
        ]);

        return redirect()->route('admin.perencanaan.index')->with('success', 'Rencana Tindak Penanganan created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_output' => 'required|string',
            'target_waktu' => 'required|date',
            'id_data_pegawai' => 'required|exists:data_pegawai,id',
        ]);

        $perencanaan = RencanaTindakPenanganan::findOrFail($id);

        $perencanaan->update([
            'name' => $request->name,
            'target_output' => $request->target_output,
            'target_waktu' => $request->target_waktu,
            'id_data_pegawai' => $request->id_data_pegawai,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Perencanaan updated successfully',
            'updated_rtp' => $perencanaan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $handlingPlan = RencanaTindakPenanganan::findOrFail($id);
        $handlingPlan->delete();

        return response()->json(['message' => 'Item deleted successfully.']);
    }

    public function getManajemen(int $id)
    {
        $manajemenResiko = ManajemenResiko::find($id);

        if (!$manajemenResiko) {
            return response()->json(['error' => 'Manajemen Resiko not found'], 404);
        }

        $resiko = $manajemenResiko->resiko->name ?? '';
        $levelKemungkinan = $manajemenResiko->levelKemungkinan->name ?? '';
        $levelDampak = $manajemenResiko->levelDampak->name ?? '';
        $matriksAnalisisResiko = $manajemenResiko->id_matriks_analisis_resiko ?? '';

        $level_kemungkinan = $manajemenResiko->id_level_kemungkinan ?? '';
        $level_dampak = $manajemenResiko->id_level_dampak ?? '';
        $idManajemenResiko = $manajemenResiko->id ?? '';

        // simpan pada json
        $data = [
            'resiko' => $resiko,
            'levelKemungkinan' => $levelKemungkinan,
            'levelDampak' => $levelDampak,
            'matriksAnalisisResiko' => $matriksAnalisisResiko,
            'level_kemungkinan' => $level_kemungkinan,
            'level_dampak' => $level_dampak,
            'idManajemenResiko' => $idManajemenResiko,
        ];

        return response()->json($data);
    }

    public function getManajemenDetail($id)
    {
        $rencanaTindakPenanganan = RencanaTindakPenanganan::where('id_manajemen_resiko', $id)
            ->get();

        //ubah rencaan tindak penanganan menjadi json
        $rencanaTindakPenanganan = $rencanaTindakPenanganan->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'target_output' => $item->target_output,
                'target_waktu' => $item->target_waktu,
                'id_data_pegawai' => $item->dataPegawai->name,
                'id_level_kemungkinan' => $item->levelKemungkinan->name,
                'id_level_dampak' => $item->levelDampak->name,
                'id_matriks_analisis_resiko' => $item->id_matriks_analisis_resiko,
                'id_manajemen_resiko' => $item->id_manajemen_resiko,
            ];
        });

        if (!$rencanaTindakPenanganan) {
            return response()->json([
                'error' => 'Rencana Tindak Penanganan not found'
            ], 404);
        } else {
            return response()->json([
                'data' => $rencanaTindakPenanganan
            ], 200);
        }
    }
}
