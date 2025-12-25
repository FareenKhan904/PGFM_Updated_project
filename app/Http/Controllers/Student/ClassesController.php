<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\ClassItem;
use App\Models\ClassMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassesController extends Controller
{
    /**
     * Display classes for enrolled courses
     */
    public function index(): View
    {
        // Get all accepted enrollments for the student
        $enrollments = Enrollment::with('course')
            ->where('user_id', Auth::id())
            ->where('status', Enrollment::STATUS_ACCEPTED)
            ->get();

        // Filter out expired enrollments
        $enrollments = $enrollments->reject(function ($enrollment) {
            return $enrollment->isExpired();
        });

        // Get all classes for enrolled courses
        $classes = ClassItem::with(['course', 'materials'])
            ->whereIn('course_id', $enrollments->pluck('course_id'))
            ->where('is_active', true)
            ->orderBy('scheduled_at', 'desc')
            ->get();

        // Group classes by course
        $classesByCourse = $classes->groupBy('course_id');

        return view('student.classes.index', compact('enrollments', 'classes', 'classesByCourse'));
    }

    /**
     * Display materials for a specific class
     */
    public function showMaterials(ClassItem $class): View
    {
        // Verify student is enrolled in the course
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $class->course_id)
            ->where('status', Enrollment::STATUS_ACCEPTED)
            ->first();

        if (!$enrollment || $enrollment->isExpired()) {
            abort(403, 'You are not enrolled in this course or your enrollment has expired.');
        }

        // Get active materials for this class
        $materials = ClassMaterial::where('course_class_id', $class->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->latest()
            ->get();

        return view('student.classes.materials', compact('class', 'materials', 'enrollment'));
    }
}
