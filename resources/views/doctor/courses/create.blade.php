@extends('layouts.doctor')

@section('title', 'Add Course - Doctor Dashboard')

@section('doctor-content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Add New Course</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('doctor.courses.store') }}" method="POST" id="courseForm">
                    @csrf

                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Basic Information</h5>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle <small class="text-muted">(Optional)</small></label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle') }}" placeholder="e.g., Postgraduate Qualification (Experience-Based Pathway)">
                            <small class="form-text text-muted">A brief subtitle that appears below the course title</small>
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Short Description <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" maxlength="2000" oninput="updateCharCount()">{{ old('description') }}</textarea>
                            <small class="form-text text-muted">
                                <span id="charCount">0</span> / 2000 characters - Brief description for course cards
                            </small>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="program_overview" class="form-label">Program Overview <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('program_overview') is-invalid @enderror" id="program_overview" name="program_overview" rows="5">{{ old('program_overview') }}</textarea>
                            <small class="form-text text-muted">Detailed overview of the program (displayed in full course view)</small>
                            @error('program_overview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Duration <small class="text-muted">(Optional)</small></label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration') }}" placeholder="e.g., 3 months, 6 weeks">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="icon_class" class="form-label">Icon Class <small class="text-muted">(Optional)</small></label>
                                <input type="text" class="form-control @error('icon_class') is-invalid @enderror" id="icon_class" name="icon_class" value="{{ old('icon_class', 'fa-graduation-cap') }}" placeholder="fa-graduation-cap">
                                <small class="form-text text-muted">FontAwesome icon class (e.g., fa-certificate, fa-stethoscope)</small>
                                @error('icon_class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-dollar-sign text-primary me-2"></i>Pricing</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fee" class="form-label">Standard Fee <small class="text-muted">(Optional)</small></label>
                                <div class="input-group">
                                    <span class="input-group-text">PKR</span>
                                    <input type="number" step="0.01" class="form-control @error('fee') is-invalid @enderror" id="fee" name="fee" value="{{ old('fee') }}" placeholder="0.00" min="0">
                                </div>
                                <small class="form-text text-muted">Leave empty if course is free</small>
                                @error('fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="early_bird_fee" class="form-label">Early Bird Fee <small class="text-muted">(Optional)</small></label>
                                <div class="input-group">
                                    <span class="input-group-text">PKR</span>
                                    <input type="number" step="0.01" class="form-control @error('early_bird_fee') is-invalid @enderror" id="early_bird_fee" name="early_bird_fee" value="{{ old('early_bird_fee') }}" placeholder="0.00" min="0">
                                </div>
                                <small class="form-text text-muted">Special early bird pricing (optional)</small>
                                @error('early_bird_fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Program Details -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-book-medical text-primary me-2"></i>Program Details <small class="text-muted">(Optional)</small></h5>
                        
                        <div class="mb-3">
                            <label for="awarding_body" class="form-label">Awarding Body <small class="text-muted">(Optional)</small></label>
                            <input type="text" class="form-control @error('awarding_body') is-invalid @enderror" id="awarding_body" name="awarding_body" value="{{ old('awarding_body') }}" placeholder="e.g., College of Physicians and Surgeons Pakistan (CPSP)">
                            @error('awarding_body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="goal" class="form-label">Goal/Purpose <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('goal') is-invalid @enderror" id="goal" name="goal" rows="2">{{ old('goal') }}</textarea>
                            <small class="form-text text-muted">The main goal or purpose of this course</small>
                            @error('goal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="qualification_purpose" class="form-label">Qualification and Purpose <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('qualification_purpose') is-invalid @enderror" id="qualification_purpose" name="qualification_purpose" rows="4">{{ old('qualification_purpose') }}</textarea>
                            <small class="form-text text-muted">Detailed explanation of the qualification and its purpose</small>
                            @error('qualification_purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Examination Information -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-clipboard-list text-primary me-2"></i>Examination Information <small class="text-muted">(Optional)</small></h5>
                        
                        <div class="mb-3">
                            <label for="examination_components" class="form-label">Examination Components <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('examination_components') is-invalid @enderror" id="examination_components" name="examination_components" rows="4" placeholder='Enter each component on a new line, e.g.&#10;Written Exam: Includes two papers with multiple-choice questions (MCQs)&#10;Practical Exam: A series of TOACS stations'>{{ old('examination_components') }}</textarea>
                            <small class="form-text text-muted">Enter each component on a new line</small>
                            @error('examination_components')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="examination_structure" class="form-label">Examination Structure <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('examination_structure') is-invalid @enderror" id="examination_structure" name="examination_structure" rows="5">{{ old('examination_structure') }}</textarea>
                            <small class="form-text text-muted">Detailed structure of the examination</small>
                            @error('examination_structure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="examination_details" class="form-label">Examination Details <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('examination_details') is-invalid @enderror" id="examination_details" name="examination_details" rows="4">{{ old('examination_details') }}</textarea>
                            <small class="form-text text-muted">Additional examination details (format, timing, etc.)</small>
                            @error('examination_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Eligibility & Requirements -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-user-check text-primary me-2"></i>Eligibility & Requirements <small class="text-muted">(Optional)</small></h5>
                        
                        <div class="mb-3">
                            <label for="eligibility_criteria" class="form-label">Eligibility Criteria <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('eligibility_criteria') is-invalid @enderror" id="eligibility_criteria" name="eligibility_criteria" rows="5" placeholder='Enter each criterion on a new line, e.g.&#10;MBBS Degree&#10;A one-year PMDC approved house job&#10;Valid PMDC/PMC registration'>{{ old('eligibility_criteria') }}</textarea>
                            <small class="form-text text-muted">Enter each criterion on a new line</small>
                            @error('eligibility_criteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="eligibility_attempts" class="form-label">Eligibility & Attempts <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('eligibility_attempts') is-invalid @enderror" id="eligibility_attempts" name="eligibility_attempts" rows="3">{{ old('eligibility_attempts') }}</textarea>
                            <small class="form-text text-muted">Information about eligibility requirements and attempt limits</small>
                            @error('eligibility_attempts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mandatory_workshops" class="form-label">Mandatory Workshops <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('mandatory_workshops') is-invalid @enderror" id="mandatory_workshops" name="mandatory_workshops" rows="4" placeholder='Enter each workshop on a new line, e.g.&#10;Basic Surgical Skills&#10;BLS (Basic Life Support)&#10;Communication Skills'>{{ old('mandatory_workshops') }}</textarea>
                            <small class="form-text text-muted">Enter each workshop on a new line</small>
                            @error('mandatory_workshops')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-book text-primary me-2"></i>Course Content <small class="text-muted">(Optional)</small></h5>
                        
                        <div class="mb-3">
                            <label for="course_modules" class="form-label">Course Modules/Specialties <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('course_modules') is-invalid @enderror" id="course_modules" name="course_modules" rows="5" placeholder='Enter each module on a new line, e.g.&#10;CVS&#10;Endocrinology&#10;Musculoskeletal&#10;Gyne & Obs'>{{ old('course_modules') }}</textarea>
                            <small class="form-text text-muted">Enter each module/specialty on a new line</small>
                            @error('course_modules')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="skills_assessed" class="form-label">Skills Assessed <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('skills_assessed') is-invalid @enderror" id="skills_assessed" name="skills_assessed" rows="5" placeholder='Enter each skill on a new line, e.g.&#10;History taking skills&#10;Physical examination skills&#10;Communication skills'>{{ old('skills_assessed') }}</textarea>
                            <small class="form-text text-muted">Enter each skill on a new line</small>
                            @error('skills_assessed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="whats_included" class="form-label">What's Included <small class="text-muted">(Optional)</small></label>
                            <textarea class="form-control @error('whats_included') is-invalid @enderror" id="whats_included" name="whats_included" rows="5" placeholder='Enter each item on a new line, e.g.&#10;4 live high-yield revision classes&#10;Latest guideline review (2024–25)&#10;PDF handouts and summary notes'>{{ old('whats_included') }}</textarea>
                            <small class="form-text text-muted">Enter each included item on a new line</small>
                            @error('whats_included')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Visibility -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-eye text-primary me-2"></i>Visibility</h5>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <strong>Active</strong> - Make this course visible on the public courses page
                                </label>
                                <small class="form-text text-muted d-block">Uncheck to hide the course from public view (students won't see it)</small>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Note:</strong> Once created, this course will automatically appear on the public courses page at <code>/courses</code> if it's marked as active. All optional fields will only be displayed if they are filled.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctor.courses.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateCharCount() {
    const textarea = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    if (textarea && charCount) {
        charCount.textContent = textarea.value.length;
        if (textarea.value.length > 1900) {
            charCount.classList.add('text-warning');
        } else {
            charCount.classList.remove('text-warning');
        }
        if (textarea.value.length >= 2000) {
            charCount.classList.add('text-danger');
        } else {
            charCount.classList.remove('text-danger');
        }
    }
}

// Initialize character count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCharCount();
});
</script>
@endsection
