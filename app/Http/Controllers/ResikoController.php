<?php

namespace App\Http\Controllers;

use App\Models\Resiko;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResikoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resiko = Resiko::all();
        return view('admin.resiko', compact('resiko'));
    }

    public function getResikoData(Request $request)
    {
        $columns = ['id', 'resiko', 'status'];

        $query = Resiko::select($columns);
        
        return DataTables::of($query)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $search = $request->search['value'];
                    $query->where('pernyataan_resiko', 'like', "%{$search}%")
                        ->orWhere('kemiripan', 'like', "%{$search}%");
                }
            })
            ->make(true);
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
            'resiko' => 'required|string|max:255',
            'status' => 'nullable|in:Accepted,On Progress,Rejected',
        ]);

        Resiko::create([
            'resiko' => $request->resiko,
            'status' => $request->status ?? 'On Progress',
        ]);

        return redirect()->back()->with('success', 'Resiko berhasil ditambahkan.');
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
        'resiko' => 'required|string|max:255',
        'status' => 'required|string|in:On Progress,Accepted,Rejected',
    ]);

    $resiko = Resiko::findOrFail($id);
    $resiko->update([
        'resiko' => $request->resiko,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.resiko.index')->with('success', 'Resiko updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
