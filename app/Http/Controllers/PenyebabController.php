<?php

namespace App\Http\Controllers;

use App\Models\Penyebab;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenyebabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyebab = Penyebab::paginate(10);
        return view('admin.penyebab', compact('penyebab'));
    }

    /**
     * Fetch penyebab data for DataTables.
     */
    public function getPenyebabData(Request $request)
    {
        $columns = ['id', 'penyebab', 'status'];

        $query = Penyebab::select($columns);

        return DataTables::of($query)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $search = $request->search['value'];
                    $query->where('penyebab', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                }
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penyebab' => 'required|string|max:255',
        ]);

        Penyebab::create([
            'penyebab' => $request->penyebab,
            'status' => $request->status ?? 'On Progress', // default status if not provided
        ]);

        return redirect()->route('admin.manajemenrisiko.index')->with('success', 'Penyebab created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penyebab = Penyebab::findOrFail($id);
        return response()->json($penyebab);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penyebab = Penyebab::findOrFail($id);

        if ($request->has('penyebab')) {
            $penyebab->penyebab = $request->input('penyebab');
        }

        if ($request->has('status')) {
            $penyebab->status = $request->input('status');
        }

        $penyebab->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update the status of the resource.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:penyebabs,id',
            'status' => 'required|string',
        ]);

        $penyebab = Penyebab::findOrFail($request->id);
        $penyebab->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'id' => $penyebab->id,
            'resiko' => $penyebab->penyebab,
            'status' => $penyebab->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penyebab = Penyebab::findOrFail($id);
        $penyebab->delete();

        return redirect()->route('admin.penyebab.index')->with('success', 'Penyebab deleted successfully.');
    }
}
