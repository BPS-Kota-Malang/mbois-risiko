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
    public function index(Request $request)
    {
        // Menangani pencarian melalui query string
        $search = $request->input('search');

        $query = Resiko::query();

        if ($search) {
            $query->where('resiko', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }

        $resiko = $query->paginate(10); // pagination data resiko
        return view('admin.resiko', compact('resiko'));
    }


    /**
     * Fetch resiko data for DataTables.
     */
    public function getResikoData(Request $request)
    {
        $columns = ['id', 'resiko', 'status'];

        $query = Resiko::select($columns);

        return DataTables::of($query)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $search = $request->search['value'];
                    $query->where('resiko', 'like', "%{$search}%")
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
            'resiko' => 'required|string|max:255',
        ]);

        Resiko::create([
            'resiko' => $request->resiko,
            'status' => $request->status ?? 'On Progress', // default status if not provided
        ]);

        return redirect()->route('admin.resiko.index')->with('success', 'Resiko created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $resiko = Resiko::findOrFail($id);
        return response()->json($resiko);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $resiko = Resiko::findOrFail($id);

        if ($request->has('resiko')) {
            $resiko->resiko = $request->input('resiko');
        }

        if ($request->has('status')) {
            $resiko->status = $request->input('status');
        }

        $resiko->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update the status of the resource.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:resikos,id',
            'status' => 'required|string',
        ]);

        $resiko = Resiko::findOrFail($request->id);
        $resiko->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'id' => $resiko->id,
            'resiko' => $resiko->resiko,
            'status' => $resiko->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resiko = Resiko::findOrFail($id);
        $resiko->delete();

        return redirect()->route('admin.resiko.index')->with('success', 'Resiko deleted successfully.');
    }
}
