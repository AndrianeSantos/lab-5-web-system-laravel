<div class="row g-3">
    <div class="col-md-4">
        <label for="student_id" class="form-label">Student ID <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('student_id') is-invalid @enderror"
               id="student_id" name="student_id" value="{{ old('student_id', $student->student_id ?? '') }}" required>
        @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
               id="first_name" name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}" required>
        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
               id="last_name" name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}" required>
        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
        <select class="form-select @error('course') is-invalid @enderror" id="course" name="course" required>
            <option value="">Select...</option>
            @foreach ($courses as $c)
                <option value="{{ $c }}" {{ old('course', $student->course ?? '') == $c ? 'selected' : '' }}>{{ $c }}</option>
            @endforeach
        </select>
        @error('course')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="year_level" class="form-label">Year Level <span class="text-danger">*</span></label>
        <select class="form-select @error('year_level') is-invalid @enderror" id="year_level" name="year_level" required>
            <option value="">Select...</option>
            @foreach ($yearLevels as $y)
                <option value="{{ $y }}" {{ old('year_level', $student->year_level ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
        @error('year_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="grade" class="form-label">Grade (0–100)</label>
        <input type="number" step="0.01" min="0" max="100"
               class="form-control @error('grade') is-invalid @enderror"
               id="grade" name="grade" value="{{ old('grade', $student->grade ?? '') }}">
        @error('grade')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
            @foreach ($statuses as $s)
                <option value="{{ $s }}" {{ old('status', $student->status ?? 'Active') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="remarks" class="form-label">Remarks</label>
        <input type="text" class="form-control @error('remarks') is-invalid @enderror"
               id="remarks" name="remarks" value="{{ old('remarks', $student->remarks ?? '') }}">
        @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
