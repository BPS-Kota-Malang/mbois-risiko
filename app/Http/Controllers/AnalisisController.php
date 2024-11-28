<?php

namespace App\Http\Controllers;

use App\Models\MatriksAnalisisResiko;
use App\Models\ProsesBisnis;
use App\Models\TimProject;
use Illuminate\Http\Request;
use App\Models\Resiko;
use App\Models\AreaDampak;
use App\Models\JenisResiko;
use App\Models\KategoriResiko;
use App\Models\Penyebab;
use App\Models\SumberResiko;
use App\Models\Dampak;
use App\Models\ManajemenResiko;
use App\Models\LevelKemungkinan;
use App\Models\LevelResiko;
use App\Models\LevelDampak;


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
            'matriksAnalisisResiko',
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