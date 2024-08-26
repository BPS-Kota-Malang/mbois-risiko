<?php

namespace App\Http\Controllers\Context;
use App\Models\ProsesBisnis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProsesBisnisController extends Controller
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
            'proses_bisnis'=> 'required|string|max:255',
        ]);

        ProsesBisnis::create([
            'proses_bisnis' => $request->proses_bisnis,
        ]);
        return redirect()->route('admin.risk.context')->with('success', 'Proses Bisnis berhasil ditambahkan.');
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
            'proses_bisnis'=> 'required|string|max:255',
        ]);

        $prosesBisnis = ProsesBisnis::findOrFail($id);
        $prosesBisnis->update([
            'proses_bisnis' => $request->proses_bisnis,
        ]);
        return redirect()->route('admin.risk.context')->with('success', 'Proses Bisnis berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prosesBisnis = ProsesBisnis::findOrFail($id);
        $prosesBisnis->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Peraturan Perundang Undangan deleted successfully.');
    }

}
