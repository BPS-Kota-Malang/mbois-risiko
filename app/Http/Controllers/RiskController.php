<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiskController extends Controller
{
    public function context()
    {
        return view('admin.risk.context');
    }

    public function identification()
    {
        return view('admin.risk.identification');
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
