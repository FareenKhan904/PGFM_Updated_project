<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function index()
    {
        // Get all enrollments for the logged-in student
        $enrollments = Enrollment::with('course')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Filter out expired enrollments (only show active ones)
        $enrollments = $enrollments->reject(function ($enrollment) {
            return $enrollment->isExpired();
        });
        
        // Group by status
        $pendingEnrollments = $enrollments->where('status', Enrollment::STATUS_PENDING);
        $acceptedEnrollments = $enrollments->where('status', Enrollment::STATUS_ACCEPTED)->reject(function ($enrollment) {
            return $enrollment->isExpired();
        });
        $rejectedEnrollments = $enrollments->where('status', Enrollment::STATUS_REJECTED);
        
        return view('student.courses.index', compact('pendingEnrollments', 'acceptedEnrollments', 'rejectedEnrollments'));
    }
}
