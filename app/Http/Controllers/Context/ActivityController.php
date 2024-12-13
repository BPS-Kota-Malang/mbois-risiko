<?php

namespace App\Http\Controllers\Context;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Action;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menangani pencarian melalui query string
        $search = $request->input('search');
        $query = Activity::query();

        if ($search) {
            $query->where('activity', 'like', "%{$search}%");
        }

        $activities = $query->paginate(10); // pagination data dampak
        return view('admin.activity', compact('activities'));
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
            'name' => 'required|string|max:255',
            'subteam' => 'required|string|max:255',
        ]);

        $activity = Activity::create([
            'name' => $request->name,
            'subteam_id' => $request->subteam
        ]);

        return redirect()->route('admin.risk.context');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }

    public function getActivities ($subteam_id)
    {
        $activities = Activity::where('subteam_id', $subteam_id)->get();

        // Return the response as JSON
        return response()->json($activities);

    }
}
