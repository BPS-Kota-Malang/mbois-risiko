<?php

namespace App\Http\Controllers;

use App\Models\Dampak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DampakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dampak = Dampak::paginate(10);
        return view('admin.dampak', compact('dampak'));
    }

    /**
     * Fetch dapek data for DataTables.
     */
    public function getDampakData(Request $request)
    {
        $columns = ['id', 'dampak', 'status'];

        $query = Dampak::select($columns);

        return DataTables::of($query)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $search = $request->search['value'];
                    $query->where('dampak', 'like', "%{$search}%")
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
            'dampak' => 'required|string|max:255',
        ]);

        Dampak::create([
            'dampak' => $request->dampak,
            'status' => $request->status ?? 'On Progress', // default status if not provided
        ]);

        return redirect()->route('admin.manajemenrisiko.index')->with('success', 'Dampak created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dampak = Dampak::findOrFail($id);
        return response()->json($dampak);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dampak = Dampak::findOrFail($id);

        if ($request->has('dampak')) {
            $dampak->dampak = $request->input('dampak');
        }

        if ($request->has('status')) {
            $dampak->status = $request->input('status');
        }

        $dampak->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update the status of the resource.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:dampaks,id',
            'status' => 'required|string',
        ]);

        $dampak = Dampak::findOrFail($request->id);
        $dampak->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'id' => $dampak->id,
            'resiko' => $dampak->dampak,
            'status' => $dampak->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dampak = Dampak::findOrFail($id);
        $dampak->delete();

        return redirect()->route('admin.dampak.index')->with('success', 'Dampak deleted successfully.');
    }
}
