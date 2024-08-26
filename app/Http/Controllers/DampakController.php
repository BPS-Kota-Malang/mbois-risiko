<?php

namespace App\Http\Controllers;
use App\Models\Dampak; 
use Illuminate\Http\Request;

class DampakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari input
        $query = $request->input('search');

        // Jika ada pencarian, filter data; jika tidak, ambil semua data
        $dampak = Dampak::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('dampak', 'like', '%' . $query . '%')
                         ->orWhere('status', 'like', '%' . $query . '%');
        })->get();

        // Kirim data ke view
        return view('admin.dampak', compact('dampak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // // Validasi data
        // $validatedData = $request->validate([
        //     'dampak' => 'required|string|max:255',
        //     'status' => 'nullable|string|max:255', // Validasi kolom status bisa kosong
        // ]);


        // // Simpan data ke database
        // Dampak::create($validatedData);

        // // Kembalikan respons
        // return response()->json(['message' => 'Data berhasil disimpan']);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'dampak' => 'required|string|max:255',
            'status' => 'required|string|in:On Progress,Accepted,Rejected',
        ]);
    
        $dampak = Dampak::findOrFail($id);
        $dampak->update([
            'dampak' => $request->dampak,
            'status' => $request->status,
        ]);
    
        return redirect()->route('admin.dampak.index')->with('success', 'Dampak updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dampak = Dampak::findOrFail($id);
        $dampak->delete();

        return redirect()->route('admin.dampak.index')->with('success', 'Dampak berhasil dihapus.');
    }
}