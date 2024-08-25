<?php

namespace App\Http\Controllers;
use App\Models\Penyebab; 
use Illuminate\Http\Request;

class PenyebabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('search');

        // Jika ada pencarian, filter data; jika tidak, ambil semua data
        $penyebab = Penyebab::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('penyebab', 'like', '%' . $query . '%')
                         ->orWhere('status', 'like', '%' . $query . '%');
        })->get();

        // Kirim data ke view
        return view('admin.penyebab', compact('penyebab'));
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
    // Validasi data
    $request->validate([
        'penyebab' => 'required|string|max:255',
        'status' => 'nullable|in:Accepted,On Progress,Rejected',
    ]);

    // Temukan entitas yang akan diperbarui
    $penyebab = Penyebab::findOrFail($id);

    // Perbarui data
    $penyebab->update([
        'penyebab' => $request->penyebab,
        'status' => $request->status ?? 'On Progress',
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->route('admin.penyebab.index')->with('success', 'Penyebab berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyebab = Penyebab::findOrFail($id);
        $penyebab->delete();

        return redirect()->route('admin.penyebab.index')->with('success', 'Penyebab berhasil dihapus.');
    }
}