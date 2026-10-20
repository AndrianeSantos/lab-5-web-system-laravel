@extends('layouts.app')

@section('title', $student->full_name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-person me-2 text-primary"></i>{{ $student->full_name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-3">
                <h5 class="mb-0">Student Details</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Student ID</dt>
                    <dd class="col-sm-9"><code>{{ $student->student_id }}</code></dd>
                    <dt class="col-sm-3">Full Name</dt>
                    <dd class="col-sm-9">{{ $student->full_name }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $student->email }}</dd>
                    <dt class="col-sm-3">Course</dt>
                    <dd class="col-sm-9">{{ $student->course }}</dd>
                    <dt class="col-sm-3">Year Level</dt>
                    <dd class="col-sm-9">{{ $student->year_level }}</dd>
                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">{{ $student->status }}</dd>
                    <dt class="col-sm-3">Remarks</dt>
                    <dd class="col-sm-9">{{ $student->remarks ?: '—' }}</dd>
                    <dt class="col-sm-3">Created</dt>
                    <dd class="col-sm-9">{{ $student->created_at->format('M d, Y H:i') }}</dd>
                    <dt class="col-sm-3">Last Updated</dt>
                    <dd class="col-sm-9">{{ $student->updated_at->format('M d, Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body text-center">
                <div class="display-4 fw-bold {{ $student->grade !== null && $student->grade < 60 ? 'text-danger' : 'text-primary' }}">
                    {{ $student->grade !== null ? number_format($student->grade, 1) : 'N/A' }}
                </div>
                <div class="text-muted">Numeric Grade</div>
                <span class="badge {{ $student->grade_badge }} mt-2 fs-6">
                    {{ $student->letter_grade }}
                    @if($student->grade !== null)
                        — {{ $student->is_passing ? 'Passing' : 'Failing' }}
                    @endif
                </span>
            </div>
        </div>
        <form action="{{ route('students.destroy', $student) }}" method="POST"
              onsubmit="return confirm('Delete this student record?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="bi bi-trash me-1"></i> Delete Student
            </button>
        </form>
    </div>
</div>
@endsection
