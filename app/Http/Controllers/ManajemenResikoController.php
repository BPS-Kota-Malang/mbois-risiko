<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManajemenResiko;
use Illuminate\Support\Facades\Log;

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
     * Add Row to Table
     */

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

    return redirect()->route('admin.risk.identification');
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
