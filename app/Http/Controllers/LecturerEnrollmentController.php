<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerEnrollmentController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $enrolledCourses = Auth::user()->lecturerCourses;

        return view('lecturer.enrollment', compact('courses', 'enrolledCourses'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'course_code' => 'required|exists:courses,course_code',
        ]);

        $course = Course::where('course_code', $request->course_code)->first();

        // Check if the lecturer is already enrolled
        if (Auth::user()->lecturerCourses->contains($course->id)) {
            return redirect()->back()->with('error', 'You are already assigned to this course.');
        }

        // Enroll the lecturer in the course
        Auth::user()->lecturerCourses()->attach($course->id);

        return redirect()->back()->with('success', 'You have successfully been assigned to the course!');
    }

    public function unenroll($courseId)
    {
        $course = Course::findOrFail($courseId);

        // Unenroll the lecturer from the course
        Auth::user()->lecturerCourses()->detach($course->id);

        return redirect()->back()->with('success', 'You have successfully been unassigned from the course.');
    }
}
