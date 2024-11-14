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


class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function perencanaan(Request $request)
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
            'matriksAnalisisResiko'
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