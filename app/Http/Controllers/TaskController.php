<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // public function index()
    // {
    //     $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
    //     return view('tasks.index', compact('tasks'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        try {
            Task::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
            ]);

            return response()->json(['success' => true, 'message' => 'Task added successfully!']);
        } catch (\Exception $e) {
            error_log('Error creating task: ' . $e->getMessage()); // Log error to terminal
            return response()->json(['success' => false, 'message' => 'Failed to add task.'], 500);
        }
    }

    public function markAsCompleted(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['is_completed' => true]);

        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }

    public function getTasksByDate(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
            ->where('date', $request->date)
            ->get();

        return response()->json($tasks);
    }

    public function getTaskCounts(Request $request)
    {
        $taskCounts = Task::where('user_id', Auth::id())
            ->selectRaw('date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        return response()->json($taskCounts);
    }
}
