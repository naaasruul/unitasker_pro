<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Auth::user()->skills ? json_decode(Auth::user()->skills, true) : [];
        return response()->json(['skills' => $skills]);
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
            'skills' => 'nullable|array', // Allow null or an array
            'skills.*' => 'string|max:255',
        ]);

        $user = Auth::user();

        // Save an empty array or null if no skills are provided
        $user->skills = $request->skills ? json_encode($request->skills) : null;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Skills saved successfully.']);
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
