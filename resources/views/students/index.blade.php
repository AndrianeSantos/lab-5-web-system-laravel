@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-people me-2 text-primary"></i>Student Records</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i> Add Student
    </a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('students.index') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Search</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Name, ID, or email..."
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label">Course</label>
                <select name="course" class="form-select">
                    <option value="all">All Courses</option>
                    @foreach ($courses as $c)
                        <option value="{{ $c }}" {{ request('course') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Year Level</label>
                <select name="year_level" class="form-select">
                    <option value="all">All Years</option>
                    @foreach ($yearLevels as $y)
                        <option value="{{ $y }}" {{ request('year_level') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="passing" {{ request('status') == 'passing' ? 'selected' : '' }}>Passing</option>
                    <option value="failing" {{ request('status') == 'failing' ? 'selected' : '' }}>Failing</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="incomplete" {{ request('status') == 'incomplete' ? 'selected' : '' }}>Incomplete</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Grade</th>
                        <th>Letter</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                    <tr class="{{ $student->grade !== null && $student->grade < 60 ? 'table-danger' : '' }}">
                        <td><code>{{ $student->student_id }}</code></td>
                        <td>
                            <a href="{{ route('students.show', $student) }}" class="text-decoration-none fw-medium">
                                {{ $student->full_name }}
                            </a>
                            <br><small class="text-muted">{{ $student->email }}</small>
                        </td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->year_level }}</td>
                        <td>
                            @if($student->grade !== null)
                                {{ number_format($student->grade, 2) }}
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $student->grade_badge }}">{{ $student->letter_grade }}</span>
                        </td>
                        <td>{{ $student->status }}</td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-outline-secondary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this student record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No students found. <a href="{{ route('students.create') }}">Add the first student</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($students->hasPages())
    <div class="card-footer bg-white">
        {{ $students->links() }}
    </div>
    @endif
</div>
@endsection
