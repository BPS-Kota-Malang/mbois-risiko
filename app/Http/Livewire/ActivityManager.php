<?php

// app/Http/Livewire/ActivityManager.php
namespace App\Http\Livewire;

use App\Models\Activity;
use Livewire\Component;

class ActivityManager extends Component
{
    public $activities, $name, $subteam_id, $activity_id;
    public $isEditMode = false;

    public function mount()
    {
        $this->activities = Activity::all();
    }

    public function render()
    {
        return view('livewire.activity-manager')->layout('layouts.app');;
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'subteam_id' => 'required|exists:subteams,id',
        ]);

        Activity::create([
            'name' => $this->name,
            'subteam_id' => $this->subteam_id,
        ]);

        $this->resetInputFields();
        $this->activities = Activity::all();
        session()->flash('message', 'Activity created successfully.');
    }

    public function edit($id)
    {
        $this->isEditMode = true;
        $activity = Activity::findOrFail($id);
        $this->activity_id = $activity->id;
        $this->name = $activity->name;
        $this->subteam_id = $activity->subteam_id;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'subteam_id' => 'required|exists:subteams,id',
        ]);

        $activity = Activity::findOrFail($this->activity_id);
        $activity->update([
            'name' => $this->name,
            'subteam_id' => $this->subteam_id,
        ]);

        $this->resetInputFields();
        $this->activities = Activity::all();
        $this->isEditMode = false;
        session()->flash('message', 'Activity updated successfully.');
    }

    public function delete($id)
    {
        Activity::findOrFail($id)->delete();
        $this->activities = Activity::all();
        session()->flash('message', 'Activity deleted successfully.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->subteam_id = '';
        $this->activity_id = null;
    }
}
