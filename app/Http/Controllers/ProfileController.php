<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index(){
        // Fetch all courses
        $courses = Course::all();
        $user = Auth::user();

        // Fetch enrolled courses based on the user's role
        if ($user->role === 'student') {
            $enrolledCourses = $user->courses; // Fetch courses from the `course_student` pivot table
        } elseif ($user->role === 'lecturer') {
            $enrolledCourses = $user->lecturerCourses; // Fetch courses from the `course_lecturer` pivot table
        } else {
            $enrolledCourses = collect(); // Empty collection for other roles
        }

        return view('layouts.profile',compact('user', 'enrolledCourses', 'courses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8',
            'skills' => 'nullable|json',
        ]);

        $user = Auth::user();

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update skills if the user is a student
        if ($user->role === 'student') {
            $user->skills = $request->skills;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::user();

        // Check if the user is a student or lecturer
        if ($user->role === 'student') {
            // Enroll the student in the course
            $user->courses()->syncWithoutDetaching([$request->course_id]);
        } elseif ($user->role === 'lecturer') {
            // Assign the lecturer to the course
            $user->lecturerCourses()->syncWithoutDetaching([$request->course_id]);
        } else {
            return redirect()->back()->with('error', 'Only students or lecturers can enroll in courses.');
        }

        return redirect()->back()->with('success', 'You have successfully enrolled in the course!');
    }

    public function unenroll($courseId)
    {
        $user = Auth::user();

        // Unenroll the user from the course
        if ($user->role === 'student') {
            $user->courses()->detach($courseId);
        } elseif ($user->role === 'lecturer') {
            $user->lecturerCourses()->detach($courseId);
        } else {
            return redirect()->back()->with('error', 'Only students or lecturers can unenroll from courses.');
        }

        return redirect()->back()->with('success', 'You have successfully unenrolled from the course!');
    }
}
