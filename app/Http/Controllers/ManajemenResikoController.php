<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManajemenResiko;

class ManajemenResikoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $data = $request->all();

            foreach ($data['resikoIds'] as $resikoId) {
                $riskManagement = new ManajemenResiko();
                $riskManagement->id_tim_project = $data['timProject'];
                $riskManagement->id_proses_bisnis = $data['prosesBisnis'];
                $riskManagement->id_resiko = $resikoId;
                $riskManagement->save();
            }

            return response()->json(['message' => 'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
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
