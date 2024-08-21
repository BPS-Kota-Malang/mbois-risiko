<?php

namespace App\Http\Controllers;
use App\Models\Penyebab; // Pastikan model ini ada
use Illuminate\Http\Request;

class PenyebabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyebab = Penyebab::all(); // Mengambil semua data dari model Penyebab
        return view('admin.penyebab', compact('penyebab')); // Mengirim data ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // // Validasi data
        // $validatedData = $request->validate([
        //     'penyebab' => 'required|string|max:255',
        //     'status' => 'nullable|string|max:255', // Validasi kolom status bisa kosong
        // ]);


        // // Simpan data ke database
        // Penyebab::create($validatedData);

        // // Kembalikan respons
        // return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd ($request);
        // Validasi data
        // $request->validate([
        //     'name' => 'required',
        // ]);



        $request->validate([
            'penyebab' => 'required|string|max:255',
            'status' => 'nullable|in:Accepted,On Progress,Rejected',
        ]);

        Penyebab::create([
            'penyebab' => $request->penyebab,
            'status' => $request->status ?? 'On Progress',
        ]);

        return redirect()->back()->with('success', 'Penyebab berhasil ditambahkan.');
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
