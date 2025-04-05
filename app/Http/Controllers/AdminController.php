<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all students from the database
        $students = User::where('role', 'student')->get();
        $lecturers = User::where('role', 'lecturer')->get();

        // Fetch the number of students registered per month for the current year
        $studentsPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('role', 'student')
            ->whereYear('created_at', now()->year) // Filter by the current year
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Fetch the number of students registered per month for the current year
        $lecturersPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('role', 'lecturer')
            ->whereYear('created_at', now()->year) // Filter by the current year
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');


        // Prepare labels and data for the chart
        $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $studentData = [];
        $lecturerData = [];

        for ($i = 1; $i <= 12; $i++) {
            $studentData[] = $studentsPerMonth[$i] ?? 0; // Use 0 if no data for the month
        }

        for ($i = 1; $i <= 12; $i++) {
            $lecturerData[] = $lecturersPerMonth[$i] ?? 0; // Use 0 if no data for the month
        }

        return view('admin.dashboard', compact('students', 'labels', 'studentData','lecturerData', 'lecturers'));
    }

    public function showManageCourse()
    {
        // Fetch all courses from the database
        $courses = Course::all();

        // Pass the courses to the view
        return view('admin.manage_course', compact('courses'));
    }

    public function showManageStudents()
    {
        // Fetch all students from the database
        $students = User::where('role', 'student')->get();

        // Pass the students to the view
        return view('admin.manage-students', compact('students'));
    }
    public function showManageLecturers()
    {
        // Fetch all lecturers from the database
        $lecturers = User::where('role', 'lecturer')->get();

        // Pass the lecturers to the view
        return view('admin.manage-lecturers', compact('lecturers'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student',
            'password' => bcrypt($request->password), // Hash the password
        ]);

        return redirect()->back()->with('success', 'Student added successfully.');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $student = User::findOrFail($id);

        // Update the student's details
        $student->name = $request->name;
        $student->email = $request->email;

        // Update the password only if a new one is provided
        if ($request->filled('password')) {
            $student->password = bcrypt($request->password);
        }

        $student->save();

        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully.');
    }

    public function storeLecturer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'lecturer',
            'password' => bcrypt($request->password), // Hash the password
        ]);

        return redirect()->back()->with('success', 'Lecturer added successfully.');
    }
    public function destroyLecturer($id)
    {
        $lecturer = User::findOrFail($id);
        $lecturer->delete();

        return redirect()->back()->with('success', 'Lecturer deleted successfully.');
    }
    
    public function updateLecturer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $lecturer = User::findOrFail($id);

        // Update the lecturer's details
        $lecturer->name = $request->name;
        $lecturer->email = $request->email;

        // Update the password only if a new one is provided
        if ($request->filled('password')) {
            $lecturer->password = bcrypt($request->password);
        }

        $lecturer->save();

        return redirect()->back()->with('success', 'Lecturer updated successfully.');
    }
    
}
