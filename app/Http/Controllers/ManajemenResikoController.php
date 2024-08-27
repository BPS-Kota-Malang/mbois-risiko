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

            // Simpan data ke database
            $riskManagement = new ManajemenResiko();
            $riskManagement->id_tim_project = $data['timProject'];
            $riskManagement->id_proses_bisnis = $data['prosesBisnis'];
            $riskManagement->id_resiko = $data['resiko'];
            $riskManagement->id_jenis_resiko = $data['jenisRisiko'];
            $riskManagement->id_sumber_resiko = $data['sumberRisiko'];
            $riskManagement->id_kategori_resiko = $data['kategoriRisiko'];
            $riskManagement->id_area_dampak = $data['areaDampak'];
            $riskManagement->id_penyebab = json_encode($data['penyebab']);
            $riskManagement->id_dampak = json_encode($data['dampak']);
            $riskManagement->save();

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
