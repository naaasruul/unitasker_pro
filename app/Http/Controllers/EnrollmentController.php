<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $enrolledCourses = Auth::user()->courses;

        return view('student.enrollment', compact('courses', 'enrolledCourses'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'course_code' => 'required|exists:courses,course_code',
        ]);

        $course = Course::where('course_code', $request->course_code)->first();

        // Check if the student is already enrolled
        if (Auth::user()->courses->contains($course->id)) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Enroll the student in the course
        Auth::user()->courses()->attach($course->id);

        return redirect()->back()->with('success', 'You have successfully enrolled in the course!');
    }

    public function unenroll($courseId)
    {
        $course = Course::findOrFail($courseId);

        // Unenroll the student from the course
        Auth::user()->courses()->detach($course->id);

        return redirect()->back()->with('success', 'You have successfully unenrolled from the course.');
    }
}
