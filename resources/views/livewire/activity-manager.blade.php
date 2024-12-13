<!-- resources/views/livewire/activity-manager.blade.php -->
<div>
    <h2>Activity Manager</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'create' }}">
        <input type="text" wire:model="name" placeholder="Activity Name" required>
        <select wire:model="subteam_id" required>
            <option value="">Select Subteam</option>
            @foreach (\App\Models\Subteam::all() as $subteam)
                <option value="{{ $subteam-> id }}">{{ $subteam->name }}</option>
            @endforeach
        </select>
        <button type="submit">{{ $isEditMode ? 'Update' : 'Create' }} Activity</button>
    </form>

    <h3>Activities List</h3>
    <ul>
        @foreach($activities as $activity)
            <li>
                {{ $activity->name }} (Subteam: {{ $activity->subteam->name }})
                <button wire:click="edit({{ $activity->id }})">Edit</button>
                <button wire:click="delete({{ $activity->id }})">Delete</button>
            </li>
        @endforeach
    </ul>
</div>
