<?php

namespace App\Http\Controllers;


use App\Models\Assignment;
use App\Models\Task;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::with('tasks')->get();
        return view('student.assignments', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function storeAssignment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        Assignment::create($request->all());
        return redirect()->back()->with('success', 'Assignment added successfully!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTask(Request $request, Assignment $assignment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $assignment->tasks()->create($request->all());
        return redirect()->back()->with('success', 'Task added successfully!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
