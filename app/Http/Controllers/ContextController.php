<?php

namespace App\Http\Controllers;

use App\Models\AreaDampak;
use App\Models\Context;
use App\Models\JenisResiko;
use App\Models\KategoriResiko;
use App\Models\KriteriaDampak;
use App\Models\KriteriaKemungkinan;
use App\Models\LevelDampak;
use App\Models\LevelKemungkinan;
use App\Models\LevelResiko;
use App\Models\MatriksAnalisisResiko;
use App\Models\OpsiPenanganan;
use App\Models\PeraturanPerundangUndangan;
use App\Models\ProsesBisnis;
use App\Models\SeleraResiko;
use App\Models\SumberResiko;
use App\Models\TimProject;
use Illuminate\Http\Request;

class ContextController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all required data
        $pemangkuKepentingan = Context::all();
        $peraturanPerundangUndangan = PeraturanPerundangUndangan::all();
        $timProjects = TimProject::all();
        $jenisResiko = JenisResiko::all();
        $sumberResiko = SumberResiko::all();
        $kategoriResiko = KategoriResiko::all();
        $areaDampak = AreaDampak::all();
        $levelKemungkinan = LevelKemungkinan::all();
        $levelDampak = LevelDampak::all();
        $levelResiko = LevelResiko::all();
        $matriksAnalisisResiko = MatriksAnalisisResiko::all();
        $seleraResiko = SeleraResiko::all();
        $opsiPenanganan = OpsiPenanganan::all();
        $prosesBisnis = ProsesBisnis::all();

        // Filter KriteriaKemungkinan
        $kriteriaKemungkinanQuery = KriteriaKemungkinan::with('kategoriResiko', 'levelKemungkinan');

        if ($request->filled('kategori_resiko')) {
            $kriteriaKemungkinanQuery->where('id_kategori_resiko', $request->input('kategori_resiko'));
        }

        if ($request->filled('level_kemungkinan')) {
            $kriteriaKemungkinanQuery->where('id_level_kemungkinan', $request->input('level_kemungkinan'));
        }

        $kriteriaKemungkinan = $kriteriaKemungkinanQuery->get();

        // Filter KriteriaDampak
        $kriteriaDampakQuery = KriteriaDampak::with('areaDampak', 'levelDampak');

        if ($request->filled('area_dampak')) {
            $kriteriaDampakQuery->where('id_area_dampak', $request->input('area_dampak'));
        }


        if ($request->filled('level_dampak')) {
            $kriteriaDampakQuery->where('id_level_dampak', $request->input('level_dampak'));
        }

        $kriteriaDampak = $kriteriaDampakQuery->get();

        return view('admin.risk.context', compact(
            'pemangkuKepentingan',
            'peraturanPerundangUndangan',
            'timProjects',
            'jenisResiko',
            'sumberResiko',
            'kategoriResiko',
            'areaDampak',
            'levelKemungkinan',
            'levelDampak',
            'kriteriaKemungkinan',
            'kriteriaDampak',
            'levelResiko',
            'matriksAnalisisResiko',
            'seleraResiko',
            'opsiPenanganan',
            'prosesBisnis'
        ));
    }

    public function forms()
    {
        return view('admin.forms');
    }

    public function tables()
    {
        return view('admin.tables');
    }

    public function uiElements()
    {
        return view('admin.ui-elements');
    }
}
