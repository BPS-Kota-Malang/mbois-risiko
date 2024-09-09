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
