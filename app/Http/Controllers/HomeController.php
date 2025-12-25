<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\News;
use App\Models\ClassItem;
use App\Models\LibraryItem;
use App\Models\SliderImage;
use App\Models\Gallery;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ((int)$user->type === User::TYPE_STUDENT) {
            // Get student enrollments with course details
            $enrollments = Enrollment::with('course')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Filter out expired enrollments (only show active ones)
            $enrollments = $enrollments->reject(function ($enrollment) {
                return $enrollment->isExpired();
            });
            
            // Group enrollments by status
            $pendingEnrollments = $enrollments->where('status', Enrollment::STATUS_PENDING);
            $acceptedEnrollments = $enrollments->where('status', Enrollment::STATUS_ACCEPTED)->reject(function ($enrollment) {
                return $enrollment->isExpired();
            });
            $rejectedEnrollments = $enrollments->where('status', Enrollment::STATUS_REJECTED);
            
            return view('student.dashboard', compact('enrollments', 'pendingEnrollments', 'acceptedEnrollments', 'rejectedEnrollments'));
        }

        if ((int)$user->type === User::TYPE_DOCTOR) {
            // Get statistics for doctor dashboard
            $stats = [
                'courses' => Course::where('user_id', $user->id)->count(),
                'active_courses' => Course::where('user_id', $user->id)->where('is_active', true)->count(),
                'news' => News::where('user_id', $user->id)->count(),
                'published_news' => News::where('user_id', $user->id)->where('is_published', true)->count(),
                'classes' => ClassItem::where('user_id', $user->id)->count(),
                'active_classes' => ClassItem::where('user_id', $user->id)->where('is_active', true)->count(),
                'library_items' => LibraryItem::where('user_id', $user->id)->count(),
                'active_library_items' => LibraryItem::where('user_id', $user->id)->where('is_active', true)->count(),
                'slider_images' => SliderImage::count(),
                'gallery_items' => Gallery::where('user_id', $user->id)->count(),
            ];
            
            // Get all enrollments for courses created by this doctor
            $enrollments = Enrollment::with(['user', 'course'])
                ->whereHas('course', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Group enrollments by status
            $pendingEnrollments = $enrollments->where('status', Enrollment::STATUS_PENDING);
            $acceptedEnrollments = $enrollments->where('status', Enrollment::STATUS_ACCEPTED);
            $rejectedEnrollments = $enrollments->where('status', Enrollment::STATUS_REJECTED);
            $pausedEnrollments = $enrollments->where('status', Enrollment::STATUS_PAUSED);
            
            // Get enrollment statistics
            $stats['total_enrollments'] = $enrollments->count();
            $stats['pending_enrollments'] = $pendingEnrollments->count();
            $stats['accepted_enrollments'] = $acceptedEnrollments->count();
            $stats['rejected_enrollments'] = $rejectedEnrollments->count();
            $stats['paused_enrollments'] = $pausedEnrollments->count();
            $stats['active_enrollments'] = $acceptedEnrollments->reject(function ($enrollment) {
                return $enrollment->isExpired();
            })->count();
            $stats['expired_enrollments'] = $acceptedEnrollments->filter(function ($enrollment) {
                return $enrollment->isExpired();
            })->count();
            
            return view('doctor.dashboard', compact('stats', 'enrollments', 'pendingEnrollments', 'acceptedEnrollments', 'rejectedEnrollments'));
        }

        // Optional fallback (e.g. if type is corrupted)
        return redirect('/')->with('error', 'Invalid user type.');
    }
}