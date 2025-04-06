<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GroupTaskController extends Controller
{
    public function index(Group $group)
    {
        // Ensure the user is authorized to view the group
        if (!$group->users->contains(Auth::id()) && $group->created_by !== Auth::id()) {
            abort(403, 'Unauthorized access to this group.');
        }

        // Fetch group tasks
        $tasks = $group->groupTasks()->orderBy('created_at', 'desc')->get();

        return view('group.todo', compact('group', 'tasks'));
    }

    public function store(Request $request, Group $group)
    {
        // Debug the incoming request
        Log::info('Request Data:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new group task
        $group->groupTasks()->create([
            'name' => $request->name,
            'description' => $request->description,
            'required_skills' => $request->required_skills,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('group-tasks.index', $group->id)->with('success', 'Task added successfully!');
    }

    public function markAsCompleted(Group $group, GroupTask $task)
    {
        // Ensure the task belongs to the group
        if ($task->group_id !== $group->id) {
            abort(403, 'Unauthorized action.');
        }

        // Mark the task as completed
        $task->update(['is_completed' => true]);

        return redirect()->route('group-tasks.index', $group->id)->with('success', 'Task marked as completed!');
    }
}
