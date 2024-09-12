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

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $ManajemenResiko = ManajemenResiko::all();
        $levelKemungkinan = LevelKemungkinan::all();
        $levelResiko = LevelResiko::all();
        $levelDampak = LevelDampak::all();
        $uraian = Uraian::all();
        $matriksAnalisisResiko = MatriksAnalisisResiko::all();


        $query = ManajemenResiko::query();

        if ($tim) {
            $query->where('id_tim_project', $tim);  // Adjust 'id_tim' to the correct column name
        }

        if ($prosesBisnis) {
            $query->where('id_proses_bisnis', $prosesBisnis);  // Adjust 'id_proses_bisnis' to the correct column name
        }

        $ManajemenResiko = $query->with(['prosesbisnis', 'tim_project', 'resiko'])->get();

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


    // public function index(Request $request)
    // {
    //     $tim = $request->input('tim');
    //     $prosesBisnis = $request->input('proses_bisnis');
    //     $query = ManajemenResiko::query();
    //     $resiko = Resiko::all();
    //     $jenisResiko = JenisResiko::all();
    //     $sumberResiko = SumberResiko::all();
    //     $kategoriResiko = KategoriResiko::all();
    //     $areaDampak = AreaDampak::all();
    //     $timProjects = TimProject::all();
    //     $penyebab = Penyebab::all();
    //     $dampak = Dampak::all();
    //     $ProsesBisnis = ProsesBisnis::all();
    //     $ManajemenResiko = ManajemenResiko::all();
    //     $levelKemungkinan = LevelKemungkinan::all();
    //     $levelResiko = LevelResiko::all();
    //     $levelDampak = LevelDampak::all();
    //     $uraian = Uraian::all(); // Tambahkan ini untuk mengambil data uraian

    //     $query = ManajemenResiko::query();

    //     if ($tim) {
    //         $query->where('id_tim_project', $tim);  // Sesuaikan 'id_tim' dengan nama kolom yang benar
    //     }

    //     if ($prosesBisnis) {
    //         $query->where('id_proses_bisnis', $prosesBisnis);  // Sesuaikan 'id_proses_bisnis' dengan nama kolom yang benar
    //     }

    //     $ManajemenResiko = $query->with(['prosesbisnis', 'tim_project', 'resiko'])->get();

    //     $matriksRisiko = MatriksAnalisisResiko::all();

    //     return view('admin.risk.analysis', compact(
    //         'jenisResiko', 'penyebab', 'sumberResiko', 'kategoriResiko', 'areaDampak', 'timProjects', 'dampak', 'resiko',
    //         'ProsesBisnis', 'ManajemenResiko', 'levelKemungkinan', 'levelResiko', 'levelDampak', 'matriksRisiko', 'uraian' // Tambahkan 'uraian' ke compact
    //     ));
    // }
    /**
     * Show the form for creating a new resource.
     */
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

        // Simpan uraian yang dipilih dalam format JSON
        $manajemenResiko->id_uraian = json_encode($validated['uraian']);
        $manajemenResiko->save();

        return response()->json(['success' => true, 'message' => 'Uraian berhasil disimpan.']);
    }

    public function hapusUraian($id, $uraian)
    {
        $dataUraian = Uraian::all();
        $manajemenResiko = ManajemenResiko::find($id);

        //ambil data dampak yang sudah ada
        $Jsonuraian = json_decode($manajemenResiko->id_uraian);
        //hapus data dampak yang dipilih
        $id_uraian = array_diff($Jsonuraian, [$uraian]);

        //ubah key array
        $id_uraian = array_values($id_uraian);

        $id_uraian = json_encode($id_uraian);

        //simpan kembali ke database
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}