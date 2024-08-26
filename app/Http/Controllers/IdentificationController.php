<?php

namespace App\Http\Controllers;
use App\Models\TimProject;// Pastikan model ini ada
use App\Models\JenisResiko; // Pastikan model ini ada
use App\Models\SumberResiko; // Pastikan model ini ada
use App\Models\KategoriResiko; // Pastikan model ini ada
use App\Models\AreaDampak; // Pastikan model ini ada
use App\Models\Penyebab; // Pastikan model ini ada
use Illuminate\Http\Request;

class IdentificationController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {


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

    public function getIdentificationData(string $id)
    {
        //
    }
}