<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get groups managed by the lecturer
        $groups = Group::where('created_by', Auth::id())->with(['users', 'groupTasks'])->get();

        // Prepare data for the view
        $groupData = $groups->map(function ($group) {
            return [
                'group_name' => $group->group_name,
                'tasks' => $group->groupTasks->map(function ($task) {
                    return [
                        'task_name' => $task->name,
                        'description' => $task->description,
                        'is_completed' => $task->is_completed,
                    ];
                }),
            ];
        });
        $groups = Group::where('created_by', Auth::id())->with(['users', 'groupTasks'])->get();
        $courses = Course::all(); // Fetch all courses

        return view('lecturer.dashboard', compact('groupData','courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Monitor chats for a specific group created by the lecturer.
     */
    public function monitorGroupChats(Group $group)
    {
        // Ensure the group belongs to the authenticated lecturer
        if ($group->created_by !== Auth::id()) {
            abort(403, 'Unauthorized access to this group.');
        }

        // Load the group with its messages and associated users
        $group->load(['messages.user']);

        return view('chat.chatroom', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
