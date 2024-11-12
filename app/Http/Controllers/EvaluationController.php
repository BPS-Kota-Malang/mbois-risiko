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

class EvaluationController extends Controller
{
    public function evaluation(Request $request)
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

        $manajemenResikos = $query->with(['prosesBisnis', 'tim_project', 'resiko', 'matriksAnalisisResiko'])->paginate(10);

        return view('admin.risk.evaluation', compact(
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
            'matriksAnalisisResiko'
        ));
    }

    public function updateResponResiko(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'respon_resiko' => 'required|in:Mengurangi Risiko,Mengalihkan Risiko,Menghindari Risiko,Menerima Risiko',
        ]);

        // Cari data berdasarkan ID
        $manajemenResiko = ManajemenResiko::findOrFail($id);

        // Tentukan nilai prioritas berdasarkan respon_resiko
        switch ($request->respon_resiko) {
            case 'Mengurangi Risiko':
                $prioritas = 1;
                break;
            case 'Mengalihkan Risiko':
                $prioritas = 2;
                break;
            case 'Menghindari Risiko':
                $prioritas = 3;
                break;
            case 'Menerima Risiko':
                $prioritas = 4;
                break;
            default:
                $prioritas = null;
        }

        // Update data di database
        $manajemenResiko->update([
            'respon_resiko' => $request->respon_resiko,
            'prioritas' => $prioritas,
        ]);

        // Kirim respon JSON
        return response()->json([
            'message' => 'Respon dan prioritas berhasil diperbarui',
            'prioritas' => $prioritas,
        ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {

    }


    public function destroy(string $id)
    {
        //
    }
}