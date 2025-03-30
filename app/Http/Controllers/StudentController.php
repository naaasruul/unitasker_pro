<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('student.dashboard');
    }

    public function joinGroup(Request $request)
    {
        $request->validate([
            'unique_code' => 'required|string|exists:groups,unique_code',
        ]);

        // Find the group by unique code
        $group = Group::where('unique_code', $request->unique_code)->first();

        // Handle case where the group does not exist
        if (!$group) {
            return redirect()->back()->with('error', 'The group with the provided unique code does not exist.');
        }

        // Check if the student is already in the group
        if ($group->users->contains(Auth::id())) {
            return redirect()->back()->with('error', 'You are already a member of this group.');
        }

        // Add the student to the group
        $group->users()->attach(Auth::id());

        return redirect()->back()->with('success', 'You have successfully joined the group!');
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
