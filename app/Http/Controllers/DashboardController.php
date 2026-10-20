<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalStudents = Student::count();
        $passingCount = Student::passing()->count();
        $failingCount = Student::failing()->count();
        $averageGrade = Student::whereNotNull('grade')->avg('grade') ?? 0;
        $incompleteCount = Student::where('status', 'Incomplete')->count();

        $recentStudents = Student::latest()->take(5)->get();
        $topStudents = Student::whereNotNull('grade')
            ->orderByDesc('grade')
            ->take(5)
            ->get();

        $courseSummary = Student::selectRaw('course, COUNT(*) as count, AVG(grade) as avg_grade')
            ->groupBy('course')
            ->orderBy('course')
            ->get();

        return view('dashboard', compact(
            'totalStudents',
            'passingCount',
            'failingCount',
            'averageGrade',
            'incompleteCount',
            'recentStudents',
            'topStudents',
            'courseSummary'
        ));
    }
}
