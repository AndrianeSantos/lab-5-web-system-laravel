@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-speedometer2 me-2 text-primary"></i>Grading Dashboard</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i> Add Student
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Students</div>
                    <div class="fs-4 fw-bold">{{ $totalStudents }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                    <i class="bi bi-check-circle fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Passing</div>
                    <div class="fs-4 fw-bold">{{ $passingCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded-3 p-3 me-3">
                    <i class="bi bi-x-circle fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Failing</div>
                    <div class="fs-4 fw-bold">{{ $failingCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-info bg-opacity-10 text-info rounded-3 p-3 me-3">
                    <i class="bi bi-graph-up fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Average Grade</div>
                    <div class="fs-4 fw-bold">{{ number_format($averageGrade, 1) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($failingCount > 0 || $incompleteCount > 0)
<div class="alert alert-warning border-0 shadow-sm mb-4">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
        <div>
            <strong>Attention!</strong>
            {{ $failingCount }} student(s) are failing and {{ $incompleteCount }} have incomplete status.
            <a href="{{ route('students.index', ['status' => 'failing']) }}" class="alert-link">View failing students</a>
        </div>
    </div>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Recently Added</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Grade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentStudents as $student)
                            <tr>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="text-decoration-none fw-medium">
                                        {{ $student->full_name }}
                                    </a>
                                    <br><small class="text-muted">{{ $student->student_id }}</small>
                                </td>
                                <td>{{ $student->course }}</td>
                                <td>
                                    @if($student->grade !== null)
                                        <span class="badge {{ $student->grade_badge }}">{{ number_format($student->grade, 1) }} ({{ $student->letter_grade }})</span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $student->status }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No students yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-primary">View All Students</a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3">
                <h5 class="mb-0"><i class="bi bi-trophy me-2 text-warning"></i>Top Performers</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topStudents as $student)
                            <tr>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="text-decoration-none fw-medium">
                                        {{ $student->full_name }}
                                    </a>
                                </td>
                                <td>{{ $student->course }}</td>
                                <td>
                                    <span class="badge {{ $student->grade_badge }}">
                                        {{ number_format($student->grade, 1) }} ({{ $student->letter_grade }})
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">No grades recorded yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($courseSummary->count() > 0)
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white border-0 pt-3">
        <h5 class="mb-0"><i class="bi bi-bar-chart me-2 text-primary"></i>Average Grade by Course</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach ($courseSummary as $row)
            <div class="col-md-4 col-sm-6">
                <div class="d-flex justify-content-between align-items-center p-3 rounded bg-light">
                    <div>
                        <div class="fw-medium">{{ $row->course }}</div>
                        <small class="text-muted">{{ $row->count }} students</small>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-primary">
                            {{ $row->avg_grade !== null ? number_format($row->avg_grade, 1) : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
