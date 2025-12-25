<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to enroll in courses.');
        }

        // Check if user is a student
        if (!Auth::user()->isStudent()) {
            return back()->with('error', 'Only students can enroll in courses.');
        }

        // Check if course is active
        if (!$course->is_active) {
            return back()->with('error', 'This course is not available for enrollment.');
        }

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with('info', 'You are already enrolled in this course.');
        }

        // Create enrollment
        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => Enrollment::STATUS_PENDING,
        ]);

        return back()->with('success', 'You have successfully enrolled in "' . $course->title . '". Your enrollment is pending approval.');
    }

    public function enrollByTitle(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to enroll in courses.');
        }

        // Check if user is a student
        if (!Auth::user()->isStudent()) {
            return back()->with('error', 'Only students can enroll in courses.');
        }

        $request->validate([
            'course_title' => 'required|string',
        ]);

        // Find course by title (fuzzy match)
        $course = Course::where('is_active', true)
            ->where(function($query) use ($request) {
                $title = $request->course_title;
                $query->where('title', 'like', "%{$title}%")
                      ->orWhere('title', $title);
            })
            ->first();

        if (!$course) {
            return back()->with('error', 'Course not found. Please contact us for enrollment.');
        }

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with('info', 'You are already enrolled in this course.');
        }

        // Create enrollment
        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => Enrollment::STATUS_PENDING,
        ]);

        return back()->with('success', 'You have successfully enrolled in "' . $course->title . '". Your enrollment is pending approval.');
    }
}
