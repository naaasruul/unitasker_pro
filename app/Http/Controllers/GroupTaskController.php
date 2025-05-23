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
        
        // Fetch all users in the group
        $users = $group->users;
        return view('group.todo', compact('group', 'tasks', 'users'));
    }

    public function store(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'required_skills' => 'nullable|json',
        ]);

        $group->groupTasks()->create([
            'name' => $request->name,
            'description' => $request->description,
            'required_skills' => $request->required_skills,
            'status' => 'not_complete', // Default status
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

    public function changeStatus(Request $request, Group $group, GroupTask $task)
    {
        $request->validate([
            'status' => 'required|in:not_complete,ongoing,completed',
            'progress' => 'nullable|string|max:1000',
            
        ]);

        // Ensure the task belongs to the group
        if ($task->group_id !== $group->id) {
            abort(403, 'Unauthorized action.');
        }

        // Update the task status and comments
        $task->update([
            'status' => $request->status,
            'progress' => $request->progress,
        ]);

        return redirect()->route('group-tasks.index', $group->id)->with('success', 'Task status updated successfully!');
    }
    public function updateProgress(Request $request, Group $group, GroupTask $task)
    {
        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ]);

        // Ensure the task belongs to the group
        if ($task->group_id !== $group->id) {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['progress' => $request->progress]);

        return redirect()->route('group-tasks.index', $group->id)->with('success', 'Task progress updated successfully!');
    }
}
