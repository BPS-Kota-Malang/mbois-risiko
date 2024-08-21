<?php

namespace App\Http\Controllers;
use App\Models\Dampak; // Pastikan model ini ada
use Illuminate\Http\Request;

class DampakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dampak = Dampak::all();
        return view('admin.dampak', compact('dampak'));
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
            'dampak' => 'required|string|max:255',
            'status' => 'nullable|in:Accepted,On Progress,Rejected',
        ]);

        Dampak::create([
            'dampak' => $request->dampak,
            'status' => $request->status ?? 'On Progress',
        ]);

        return redirect()->back()->with('success', 'Dampak berhasil ditambahkan.');
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
