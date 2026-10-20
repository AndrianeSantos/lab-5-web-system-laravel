<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course') && $request->course !== 'all') {
            $query->where('course', $request->course);
        }

        if ($request->filled('year_level') && $request->year_level !== 'all') {
            $query->where('year_level', $request->year_level);
        }

        if ($request->filled('status')) {
            match ($request->status) {
                'passing' => $query->passing(),
                'failing' => $query->failing(),
                'active' => $query->where('status', 'Active'),
                'incomplete' => $query->where('status', 'Incomplete'),
                default => null,
            };
        }

        $students = $query->orderBy('last_name')->orderBy('first_name')
                          ->paginate(10)->withQueryString();

        $courses = Student::select('course')->distinct()->orderBy('course')->pluck('course');
        $yearLevels = Student::select('year_level')->distinct()->orderBy('year_level')->pluck('year_level');

        return view('students.index', compact('students', 'courses', 'yearLevels'));
    }

    public function create(): View
    {
        $courses = ['BSIT', 'BSCS', 'BSIS', 'BSBA', 'BSED', 'BSCE', 'BSEE'];
        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        $statuses = ['Active', 'Incomplete', 'Dropped'];

        return view('students.create', compact('courses', 'yearLevels', 'statuses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:20|unique:students,student_id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:students,email',
            'course' => 'required|string|max:50',
            'year_level' => 'required|string|max:20',
            'grade' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|string|in:Active,Incomplete,Dropped',
            'remarks' => 'nullable|string|max:500',
        ], [
            'student_id.unique' => 'This Student ID already exists.',
            'email.unique' => 'This email is already registered.',
            'grade.min' => 'Grade cannot be less than 0.',
            'grade.max' => 'Grade cannot be greater than 100.',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
                         ->with('success', 'Student record created successfully.');
    }

    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        $courses = ['BSIT', 'BSCS', 'BSIS', 'BSBA', 'BSED', 'BSCE', 'BSEE'];
        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        $statuses = ['Active', 'Incomplete', 'Dropped'];

        return view('students.edit', compact('student', 'courses', 'yearLevels', 'statuses'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:20|unique:students,student_id,' . $student->id,
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'course' => 'required|string|max:50',
            'year_level' => 'required|string|max:20',
            'grade' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|string|in:Active,Incomplete,Dropped',
            'remarks' => 'nullable|string|max:500',
        ], [
            'student_id.unique' => 'This Student ID already exists.',
            'email.unique' => 'This email is already registered.',
            'grade.min' => 'Grade cannot be less than 0.',
            'grade.max' => 'Grade cannot be greater than 100.',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
                         ->with('success', 'Student record updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Student record deleted successfully.');
    }
}
