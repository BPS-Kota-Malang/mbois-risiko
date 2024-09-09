<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\AnalisisResiko;
use App\Models\ProsesBisnis;
use App\Models\TimProject;
use App\Models\ManajemenResiko;
use App\Models\LevelKemungkinan;
use App\Models\LevelResiko;
use App\Models\LevelDampak;
=======


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
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
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

=======
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
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        // Provide data needed for creating a new resource if applicable
        $timProjects = TimProject::all();
        $prosesBisnis = ProsesBisnis::all();
        $levelKemungkinans = LevelKemungkinan::all();
        $levelResikos = LevelResiko::all();
        $levelDampaks = LevelDampak::all();

        return view('admin.risk.create', compact('timProjects', 'prosesBisnis', 'levelKemungkinans', 'levelResikos', 'levelDampaks'));
=======
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
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
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
=======
        //
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
<<<<<<< HEAD
        // Find resource by ID
        $analisis = AnalisisResiko::findOrFail($id);
        return view('admin.risk.show', compact('analisis'));
=======
        //
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
<<<<<<< HEAD
        // Find resource by ID
        $analisis = AnalisisResiko::findOrFail($id);
        $timProjects = TimProject::all();
        $prosesBisnis = ProsesBisnis::all();
        $levelKemungkinans = LevelKemungkinan::all();
        $levelResikos = LevelResiko::all();
        $levelDampaks = LevelDampak::all();

        return view('admin.risk.edit', compact('analisis', 'timProjects', 'prosesBisnis', 'levelKemungkinans', 'levelResikos', 'levelDampaks'));
=======
        //
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
<<<<<<< HEAD
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


=======
        //
    }

>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
<<<<<<< HEAD
        // Find and delete resource
        $analisis = AnalisisResiko::findOrFail($id);
        $analisis->delete();

        return redirect()->route('admin.analisis.index')->with('success', 'Analisis berhasil dihapus.');
    }
}
=======
        //
    }
}
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
