<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;

class CoursesController extends Controller
{
    public function index(): View
    {
        // Get all active courses for enrollment
        $courses = Course::where('is_active', true)
            ->orderBy('title')
            ->get();
        
        // Map course titles to help with enrollment
        $courseMap = [
            'MCPS Family Medicine' => $courses->firstWhere('title', 'like', '%MCPS Family Medicine%'),
            'MRCGP INT South Asia' => $courses->firstWhere('title', 'like', '%MRCGP%'),
            'MCPS Family Medicine TOACS' => $courses->firstWhere('title', 'like', '%TOACS%'),
            'MRCGP INT South Asia OSCE' => $courses->firstWhere('title', 'like', '%OSCE%'),
        ];
        
        return view('courses', compact('courses', 'courseMap'));
    }
}



