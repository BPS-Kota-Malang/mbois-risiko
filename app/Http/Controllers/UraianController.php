<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use Yajra\DataTables\Facades\DataTables;


use Illuminate\Http\Request;

class UraianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menangani pencarian melalui query string
        $search = $request->input('search');

        $query = Uraian::query();

        if ($search) {
            $query->where('uraian', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }

        $uraian = $query->paginate(10); // pagination data uraian
        return view('admin.uraian', compact('uraian'));
    }



    public function getUraianData(Request $request)
    {
        $columns = ['id', 'uraian', 'status'];

        $query = Uraian::select($columns);

        return DataTables::of($query)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->search['value'])) {
                    $search = $request->search['value'];
                    $query->where('uraian', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
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
            'uraian' => 'required|string|max:255',
        ]);

        Uraian::create([
            'uraian' => $request->uraian,
            'status' => $request->status ?? 'On Progress', // default status if not provided
        ]);

        return redirect()->route('admin.analisis.index')->with('success', 'Uraian created successfully.');
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
    public function edit($id)
    {
        $uraian = Uraian::findOrFail($id);
        return response()->json($uraian);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $uraian = Uraian::findOrFail($id);

        if ($request->has('uraian')) {
            $uraian->uraian = $request->input('uraian');
        }

        if ($request->has('status')) {
            $uraian->status = $request->input('status');
        }

        $uraian->save();

        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:uraians,id',
            'status' => 'required|string',
        ]);

        $uraian = Uraian::findOrFail($request->id);
        $uraian->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'id' => $uraian->id,
            'resiko' => $uraian->uraian,
            'status' => $uraian->status,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $uraian = Uraian::findOrFail($id);
        $uraian->delete();

        return redirect()->route('admin.uraian.index')->with('success', 'Uraian deleted successfully.');
    }

}
