<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resiko;
use App\Models\AreaDampak;
use App\Models\JenisResiko;
use App\Models\KategoriResiko;
use App\Models\Penyebab;
use App\Models\SumberResiko;
use App\Models\TimProject;
use App\Models\ProsesBisnis;
use App\Models\Dampak;
use App\Models\ManajemenResiko;

class ManajemenResikoController extends Controller
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


        $query = ManajemenResiko::query();

        if ($tim) {
            $query->where('id_tim_project', $tim);  // Adjust 'id_tim' to the correct column name
        }

        if ($prosesBisnis) {
            $query->where('id_proses_bisnis', $prosesBisnis);  // Adjust 'id_proses_bisnis' to the correct column name
        }

        $ManajemenResiko = $query->with(['prosesbisnis', 'tim_project', 'resiko'])->get();

        return view('admin.risk.identification', compact(
            'jenisResiko', 'penyebab', 'sumberResiko', 'kategoriResiko',
            'areaDampak', 'timProjects', 'dampak', 'resiko', 'ProsesBisnis', 'ManajemenResiko'
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
     * Add Row to Table
     */

    //  public function initialStore(Request $request)
    // {
    //      // Retrieve the array of selected IDs and form values
    //      $selectedIds = $request->input('data', []);
    //      $formValues = $request->input('formValues', []);

    //      // Validate formValues to ensure they exist
    //      $tim = $formValues['tim'] ?? null;
    //      $prosesBisnis = $formValues['proses_bisnis'] ?? null;

    //      // Check if required values are provided
    //      if (!$tim || !$prosesBisnis) {
    //          return response()->json([
    //              'errors' => 'Tim and Proses Bisnis are required.'
    //          ], 400);
    //      }

    //      // Create records for each selected ID
    //      foreach ($selectedIds as $id) {
    //          ManajemenResiko::create([
    //              'id_resiko' => $id,
    //              'id_tim_project' => $tim,
    //              'id_proses_bisnis' => $prosesBisnis,
    //          ]);
    //      }

    //      return response()->json([
    //          'success' => true,
    //          'message' => 'Data berhasil disimpan.'
    //      ]);
    // }

     public function initialStore (Request $request)
     {
        // Retrieve the array of selected IDs and form values
        $selectedIds = $request->input('data', []);
        $formValues = $request->input('formValues', []);

        // Validate formValues to ensure they exist
        $tim = $formValues['tim'] ?? null;
        $prosesBisnis = $formValues['proses_bisnis'] ?? null;

        // Check if required values are provided
        if (!$tim || !$prosesBisnis) {
            return response()->json([
                'errors' => 'Tim and Proses Bisnis are required.'
            ], 400);
        }

        // Create records for each selected ID
        foreach ($selectedIds as $id) {
            ManajemenResiko::create([
                'id_resiko' => $id,
                'id_tim_project' => $tim,
                'id_proses_bisnis' => $prosesBisnis,
            ]);
        }

        return redirect()->route('admin.manajemenrisiko.index')->with('success', 'Data berhasil disimpan.');
     }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manajemenResikoIds = $request->input('manajemen_resiko_ids', []);
        $jenisResiko = $request->input('jenis_resiko', []);
        $sumberResiko = $request->input('sumber_resiko', []);
        $kategoriResiko = $request->input('kategori_resiko', []);
        $areaDampak = $request->input('area_dampak', []);

        foreach ($manajemenResikoIds as $index => $id) {
            $manajemenResiko = ManajemenResiko::find($id);

            if ($manajemenResiko) {
                // Update existing record
                $manajemenResiko->id_jenis_resiko = $jenisResiko[$index] ?? $manajemenResiko->id_jenis_resiko;
                $manajemenResiko->id_sumber_resiko = $sumberResiko[$index] ?? $manajemenResiko->id_sumber_resiko;
                $manajemenResiko->id_kategori_resiko = $kategoriResiko[$index] ?? $manajemenResiko->id_kategori_resiko;
                $manajemenResiko->id_area_dampak = $areaDampak[$index] ?? $manajemenResiko->id_area_dampak;
                $manajemenResiko->save();
            } else {
                // Create new record
                ManajemenResiko::create([
                    'id' => $id,
                    'id_jenis_resiko' => $jenisResiko[$index] ?? null,
                    'id_sumber_resiko' => $sumberResiko[$index] ?? null,
                    'id_kategori_resiko' => $kategoriResiko[$index] ?? null,
                    'id_area_dampak' => $areaDampak[$index] ?? null,
                    // Tambahkan field lain yang diperlukan
                ]);
            }
        }

        return redirect()->route('admin.manajemenrisiko.index')->with('success', 'Data berhasil disimpan.');

    }

    public function saveDampak(Request $request)
    {
        $request->validate([
            'dampak' => 'required|array',
            'manajemen_resiko_id' => 'required|exists:manajemen_resiko,id',
        ]);

        $manajemenResiko = ManajemenResiko::find($request->manajemen_resiko_id);
        // dd($request->dampak);
        if (!$manajemenResiko) {
            return response()->json(['success' => false, 'message' => 'Manajemen Resiko tidak ditemukan.'], 404);
        }

        // Simpan ID dampak yang dipilih dalam format JSON
        $manajemenResiko->id_dampak = json_encode($request->dampak);
        $manajemenResiko->save();

        return response()->json(['success' => true, 'message' => 'Dampak berhasil disimpan.']);
    }


    public function savePenyebab(Request $request)
    {
        $request->validate([
            'penyebab' => 'required|array',
            'manajemen_resiko_id' => 'required|exists:manajemen_resiko,id',
        ]);

        $manajemenResiko = ManajemenResiko::find($request->manajemen_resiko_id);

        if (!$manajemenResiko) {
            return response()->json(['success' => false, 'message' => 'Manajemen Resiko tidak ditemukan.'], 404);
        }

        // Simpan penyebab yang dipilih dalam format JSON
        $manajemenResiko->id_penyebab = json_encode($request->penyebab);
        $manajemenResiko->save();

        return response()->json(['success' => true, 'message' => 'Penyebab berhasil disimpan.']);
    }

    public function hapusPenyebab($id, $penyebab)
    {
        $manajemenResiko = ManajemenResiko::find($id);

        if (!$manajemenResiko) {
            return redirect()->route('admin.manajemenrisiko.index')->with('error', 'Manajemen Resiko tidak ditemukan.');
        }

        // Ambil data penyebab yang sudah ada
        $Jsonpenyebab = json_decode($manajemenResiko->id_penyebab, true);

        if (!is_array($Jsonpenyebab)) {
            return redirect()->route('admin.manajemenrisiko.index')->with('error', 'Data penyebab tidak valid.');
        }

        // Hapus data penyebab yang dipilih
        $id_penyebab = array_diff($Jsonpenyebab, [$penyebab]);

        // Ubah key array
        $id_penyebab = array_values($id_penyebab);

        $id_penyebab = json_encode($id_penyebab);

        // Simpan kembali ke database
        $manajemenResiko->id_penyebab = $id_penyebab;
        $manajemenResiko->save();

        // Response route
        return redirect()->route('admin.manajemenrisiko.index')->with('success', 'Data berhasil dihapus.');
    }


    public function hapusDampak($id, $dampak)
    {
        $manajemenResiko = ManajemenResiko::find($id);

        if (!$manajemenResiko) {
            return redirect()->route('admin.manajemenrisiko.index')->with('error', 'Manajemen Resiko tidak ditemukan.');
        }

        // Ambil data dampak yang sudah ada
        $jsonDampak = json_decode($manajemenResiko->id_dampak, true);

        if (!is_array($jsonDampak)) {
            return redirect()->route('admin.manajemenrisiko.index')->with('error', 'Data dampak tidak valid.');
        }

        // Hapus data dampak yang dipilih
        $id_dampak = array_diff($jsonDampak, [$dampak]);

        // Ubah key array
        $id_dampak = array_values($id_dampak);

        $id_dampak = json_encode($id_dampak);

        // Simpan kembali ke database
        $manajemenResiko->id_dampak = $id_dampak;
        $manajemenResiko->save();

        // Response route
        return redirect()->route('admin.manajemenrisiko.index')->with('success', 'Data berhasil dihapus.');
    }

    //backup punya savedampak
    // public function saveDampak(Request $request)
    // {
    //     $request->validate([
    //         'dampak' => 'required|array',
    //         'manajemen_resiko_id' => 'required|exists:manajemen_resiko,id',
    //     ]);

    //     $manajemenResiko = ManajemenResiko::find($request->manajemen_resiko_id);

    //     if (!$manajemenResiko) {
    //         return response()->json(['success' => false, 'message' => 'Manajemen Resiko tidak ditemukan.'], 404);
    //     }

    //     // Simpan dampak yang dipilih dalam format JSON
    //     $manajemenResiko->id_dampak = json_encode($request->dampak);
    //     $manajemenResiko->save();

    //     return response()->json(['success' => true, 'message' => 'Dampak berhasil disimpan.']);
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $manajemenResiko = ManajemenResiko::findOrFail($id);
        return view('admin.risk.identification', compact('manajemenResiko'));
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
    public function destroy($id)
    {
        $ManajemenResiko = ManajemenResiko::find($id);
        $ManajemenResiko->delete();

        return redirect()->route('admin.manajemenrisiko.index')->with('success', 'Data berhasil dihapus.');
    }
}
