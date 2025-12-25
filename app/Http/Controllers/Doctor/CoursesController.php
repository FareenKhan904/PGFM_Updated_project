<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CoursesController extends Controller
{
    /**
     * Display a listing of the courses
     */
    public function index(): View
    {
        $courses = Course::where('user_id', Auth::id())->latest()->paginate(10);
        return view('doctor.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course
     */
    public function create(): View
    {
        return view('doctor.courses.create');
    }

    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'program_overview' => 'nullable|string',
            'duration' => 'nullable|string|max:255',
            'fee' => 'nullable|numeric|min:0',
            'early_bird_fee' => 'nullable|numeric|min:0',
            'awarding_body' => 'nullable|string|max:255',
            'goal' => 'nullable|string',
            'examination_components' => 'nullable|string',
            'eligibility_criteria' => 'nullable|string',
            'mandatory_workshops' => 'nullable|string',
            'course_modules' => 'nullable|string',
            'examination_structure' => 'nullable|string',
            'qualification_purpose' => 'nullable|string',
            'examination_details' => 'nullable|string',
            'skills_assessed' => 'nullable|string',
            'eligibility_attempts' => 'nullable|string',
            'whats_included' => 'nullable|string',
            'icon_class' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        // Convert newline-separated strings to arrays for JSON storage
        $data = $validated;
        $data['user_id'] = Auth::id();
        $data['is_active'] = $request->has('is_active') ? true : false;
        
        // Convert text fields with newlines to arrays
        foreach (['examination_components', 'eligibility_criteria', 'mandatory_workshops', 'course_modules', 'skills_assessed', 'whats_included'] as $field) {
            if (!empty($data[$field])) {
                $data[$field] = array_filter(array_map('trim', explode("\n", $data[$field])));
            } else {
                $data[$field] = null;
            }
        }

        Course::create($data);

        return redirect()->route('doctor.courses.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Show the form for editing the specified course
     */
    public function edit(Course $course): View
    {
        // Ensure the course belongs to the authenticated doctor
        if ((int)$course->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('doctor.courses.edit', compact('course'));
    }

    /**
     * Update the specified course
     */
    public function update(Request $request, Course $course)
    {
        // Ensure the course belongs to the authenticated doctor
        if ((int)$course->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'program_overview' => 'nullable|string',
            'duration' => 'nullable|string|max:255',
            'fee' => 'nullable|numeric|min:0',
            'early_bird_fee' => 'nullable|numeric|min:0',
            'awarding_body' => 'nullable|string|max:255',
            'goal' => 'nullable|string',
            'examination_components' => 'nullable|string',
            'eligibility_criteria' => 'nullable|string',
            'mandatory_workshops' => 'nullable|string',
            'course_modules' => 'nullable|string',
            'examination_structure' => 'nullable|string',
            'qualification_purpose' => 'nullable|string',
            'examination_details' => 'nullable|string',
            'skills_assessed' => 'nullable|string',
            'eligibility_attempts' => 'nullable|string',
            'whats_included' => 'nullable|string',
            'icon_class' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        // Convert text fields with newlines to arrays
        foreach (['examination_components', 'eligibility_criteria', 'mandatory_workshops', 'course_modules', 'skills_assessed', 'whats_included'] as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = array_filter(array_map('trim', explode("\n", $validated[$field])));
            } else {
                $validated[$field] = null;
            }
        }

        $course->update($validated);

        return redirect()->route('doctor.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified course
     */
    public function destroy(Course $course)
    {
        // Ensure the course belongs to the authenticated doctor
        if ((int)$course->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $course->delete();

        return redirect()->route('doctor.courses.index')
            ->with('success', 'Course deleted successfully!');
    }
}
