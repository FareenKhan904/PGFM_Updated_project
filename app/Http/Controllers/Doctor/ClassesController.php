<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClassItem;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassesController extends Controller
{
    /**
     * Display a listing of the classes
     */
    public function index(): View
    {
        $classes = ClassItem::with(['course', 'materials'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('doctor.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new class
     */
    public function create(): View
    {
        $courses = Course::where('user_id', Auth::id())
            ->where('is_active', true)
            ->orderBy('title')
            ->get();
        return view('doctor.classes.create', compact('courses'));
    }

    /**
     * Store a newly created class
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'scheduled_at' => 'required|date|after:now',
            'duration' => 'nullable|string|max:255',
            'meeting_link' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        // Verify course belongs to the doctor
        $course = Course::findOrFail($validated['course_id']);
        if ((int)$course->user_id !== (int)Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        ClassItem::create([
            'user_id' => Auth::id(),
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'scheduled_at' => $validated['scheduled_at'],
            'duration' => $validated['duration'] ?? null,
            'meeting_link' => $validated['meeting_link'] ?? null,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('doctor.classes.index')
            ->with('success', 'Class created successfully!');
    }

    /**
     * Show the form for editing the specified class
     */
    public function edit(ClassItem $class): View
    {
        // Ensure the class belongs to the authenticated doctor
        if ((int)$class->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $courses = Course::where('user_id', Auth::id())
            ->where('is_active', true)
            ->orderBy('title')
            ->get();
        return view('doctor.classes.edit', compact('class', 'courses'));
    }

    /**
     * Update the specified class
     */
    public function update(Request $request, ClassItem $class)
    {
        // Ensure the class belongs to the authenticated doctor
        if ((int)$class->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'scheduled_at' => 'required|date',
            'duration' => 'nullable|string|max:255',
            'meeting_link' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        // Verify course belongs to the doctor
        $course = Course::findOrFail($validated['course_id']);
        if ((int)$course->user_id !== (int)Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $class->update($validated);

        return redirect()->route('doctor.classes.index')
            ->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified class
     */
    public function destroy(ClassItem $class)
    {
        // Ensure the class belongs to the authenticated doctor
        if ((int)$class->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $class->delete();

        return redirect()->route('doctor.classes.index')
            ->with('success', 'Class deleted successfully!');
    }
}
