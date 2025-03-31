<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->tasks()->create($request->only('name', 'description'));

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    public function markAsCompleted(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['is_completed' => true]);

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }
}
