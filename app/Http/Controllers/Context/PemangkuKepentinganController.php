<?php

namespace App\Http\Controllers\Context;
use App\Models\Context;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemangkuKepentinganController extends Controller
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
            'name' => 'required|string|max:255',
            'kelompok' => 'required|string|max:255',
            'hubungan' => 'nullable|string|max:255',
        ]);

        Context::create([
            'name' => $request->name,
            'kelompok' => $request->kelompok,
            'hubungan' => $request->hubungan,
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
            'name' => 'required|string|max:255',
            'kelompok' => 'required|string|max:255',
            'hubungan' => 'nullable|string|max:255',
        ]);

        $pemangkuKepentingan = Context::findOrFail($id);
        $pemangkuKepentingan->name = $request->name;
        $pemangkuKepentingan->kelompok = $request-> kelompok;
        $pemangkuKepentingan->hubungan = $request->hubungan;
        $pemangkuKepentingan->save();

        return redirect()->route('admin.risk.context')->with('success', 'Pemangku Kepentingan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemangkuKepentingan = Context::findOrFail($id);
        $pemangkuKepentingan->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Pemangku Kepentingan deleted successfully.');
    }
}