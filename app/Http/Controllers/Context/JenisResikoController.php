<?php

namespace App\Http\Controllers\Context;
use App\Models\JenisResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisResikoController extends Controller
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
        $request->validate([
            'kode' => 'required|string|max:255',
            'jenis_resiko' => 'required|string|max:255',
        ]);

        JenisResiko::create([
            'kode' => $request->kode,
            'jenis_resiko' => $request->jenis_resiko,
        ]);

        return redirect()->route('admin.risk.context');
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
        $request->validate([
            'kode' => 'required|string|max:255',
            'jenis_resiko' => 'required|string|max:255',
        ]);

        $jenisResiko = JenisResiko::findOrFail($id);
        $jenisResiko->update([
            'kode' => $request->kode,
            'jenis_resiko' => $request->jenis_resiko,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Jenis Resiko updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisResiko = JenisResiko::findOrFail($id);
        $jenisResiko->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Jenis Resiko deleted successfully.');
    }
}
