<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Store a newly created course in the database.
     */
    public function index(){
        $courses = Course::all();
        return view('admin.manage_course', compact('courses'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255|unique:courses,course_code',
            'course_credit_hours' => 'required|integer|min:1',
        ]);

        // Create the course
        Course::create([
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'course_credit_hours' => $request->course_credit_hours,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Course created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255|unique:courses,course_code,' . $id,
            'course_credit_hours' => 'required|integer|min:1',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect()->back()->with('success', 'Course updated successfully!');
    }
    
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully!');
    }
}
