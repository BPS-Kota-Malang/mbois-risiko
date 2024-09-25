<?php

namespace App\Http\Controllers;
use App\Models\Uraian;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class UraianContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');

        // Jika ada pencarian, filter data; jika tidak, ambil semua data
        $uraian = Uraian::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('uraian', 'like', '%' . $query . '%')
                         ->orWhere('status', 'like', '%' . $query . '%');
        })->get();

        // Kirim data ke view
        return view('admin.uraian', compact('uraian'));
    }


    public function getUraianData(Request $request)
    {
        if ($request->ajax()) {
            $data = Uraian::select(['id', 'uraian', 'status']);
            return DataTables::of($data)->make(true);
        }
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
            'uraian' => 'required|string|max:255',
            'status' => 'nullable|in:Accepted,On Progress,Rejected',
        ]);

        Uraian::create([
            'uraian' => $request->uraian,
            'status' => $request->status ?? 'On Progress',
        ]);

        return redirect()->back()->with('success', 'Uraian berhasil ditambahkan.');
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
            'uraian' => 'required|string|max:255',
            'status' => 'required|string|in:On Progress,Accepted,Rejected',
        ]);

        $uraian = Uraian::findOrFail($id);
        $uraian->update([
            'uraian' => $request->uraian,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.uraian.index')->with('success', 'Uraian updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $uraian = Uraian::findOrFail($id);
        $uraian->delete();

        return redirect()->route('admin.uraian.index')->with('success', 'Uraian berhasil dihapus.');
    }

}
