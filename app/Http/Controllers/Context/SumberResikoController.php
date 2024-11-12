<?php

namespace App\Http\Controllers\Context;
use App\Models\SumberResiko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SumberResikoController extends Controller
{

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SumberResiko::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Sumber Resiko created successfully.');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sumberResiko = SumberResiko::findOrFail($id);
        $sumberResiko->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.risk.context')->with('success', 'Sumber Resiko updated successfully.');
    }

    public function destroy(string $id)
    {
        $sumberResiko = SumberResiko::findOrFail($id);
        $sumberResiko->delete();

        return redirect()->route('admin.risk.context')->with('success', 'Sumber Resiko deleted successfully.');

    }
}
