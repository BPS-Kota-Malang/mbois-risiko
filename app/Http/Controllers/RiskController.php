<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RiskController extends Controller
{
    public function context()
    {
        return view('admin.risk.context');
    }

    public function identification()
    {
        $resiko = Resiko::all();
        $jenisResiko = JenisResiko::all();
        $sumberResiko = SumberResiko::all();
        $kategoriResiko = KategoriResiko::all();
        $areaDampak = AreaDampak::all();
        $timProjects = TimProject::all();
        $penyebab = Penyebab::all();
        $dampak = Dampak::all();
        $ProsesBisnis = ProsesBisnis::all();

        // $ManajemenResikos = DB::table('manajemen_resiko')
        // ->join('resiko', 'manajemen_resiko.id_resiko', '=', 'resiko.id')
        // ->select('manajemen_resiko.*', 'resiko.resiko as resiko')
        // ->get();

        $ManajemenResikos = ManajemenResiko::all();
        // $selectedTeam = TimProject::first();



        return view('admin.risk.identification', compact('jenisResiko', 'penyebab',
         'sumberResiko', 'kategoriResiko',
         'areaDampak', 'timProjects',
          'dampak', 'resiko', 'ProsesBisnis', 'ManajemenResikos'));
}

    public function analysis()
    {
        return view('admin.risk.analysis');
    }

    public function evaluation()
    {
        return view('admin.risk.evaluation');
    }

    public function actionPlan()
    {
        return view('admin.risk.action_plan');
    }
}
