<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function index()
    {
        // Get all enrollments for courses created by the logged-in doctor
        $enrollments = Enrollment::with(['user', 'course'])
            ->whereHas('course', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Group by status
        $pendingEnrollments = $enrollments->where('status', Enrollment::STATUS_PENDING);
        $acceptedEnrollments = $enrollments->where('status', Enrollment::STATUS_ACCEPTED);
        $rejectedEnrollments = $enrollments->where('status', Enrollment::STATUS_REJECTED);
        $pausedEnrollments = $enrollments->where('status', Enrollment::STATUS_PAUSED);
        
        return view('doctor.enrollments.index', compact('pendingEnrollments', 'acceptedEnrollments', 'rejectedEnrollments', 'pausedEnrollments'));
    }
    
    public function update(Request $request, Enrollment $enrollment)
    {
        // First, verify that this enrollment belongs to a course created by this doctor
        // This prevents accessing enrollments from other doctors' courses
        $enrollmentBelongsToDoctor = Enrollment::where('id', $enrollment->id)
            ->whereHas('course', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->exists();
        
        if (!$enrollmentBelongsToDoctor) {
            return back()->with('error', 'Unauthorized action. You can only manage enrollments for your own courses.');
        }
        
        // Eager load the course relationship
        $enrollment->load('course');
        
        // Verify that the enrollment has a course
        if (!$enrollment->course) {
            return back()->with('error', 'Course not found for this enrollment.');
        }
        
        // Double-check with strict integer comparison
        $courseUserId = (int) $enrollment->course->user_id;
        $currentUserId = (int) Auth::id();
        
        if ($courseUserId !== $currentUserId) {
            return back()->with('error', 'Unauthorized action. You can only manage enrollments for your own courses.');
        }
        
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        // Set approved_at when status changes to accepted
        $updateData = [
            'status' => $request->status,
            'notes' => $request->notes,
        ];
        
        // If status is being changed to accepted and approved_at is not set, set it now
        if ($request->status == Enrollment::STATUS_ACCEPTED && !$enrollment->approved_at) {
            $updateData['approved_at'] = now();
        }
        
        // If status is being changed away from accepted (to paused or rejected), keep approved_at but enrollment is inactive
        // Only clear approved_at if going to rejected
        if ($request->status == Enrollment::STATUS_REJECTED) {
            $updateData['approved_at'] = null;
        }
        
        $enrollment->update($updateData);
        
        // Set appropriate status message
        $statusMessages = [
            Enrollment::STATUS_PENDING => 'pending',
            Enrollment::STATUS_ACCEPTED => 'accepted',
            Enrollment::STATUS_REJECTED => 'rejected',
            Enrollment::STATUS_PAUSED => 'paused/deactivated',
        ];
        
        $statusText = $statusMessages[$request->status] ?? 'updated';
        
        return back()->with('success', "Enrollment has been {$statusText} successfully.");
    }
}
