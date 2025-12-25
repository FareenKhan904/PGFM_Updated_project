<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MentorshipController extends Controller
{
    public function index(): View
    {
        return view('doctor.mentorship.index');
    }
}
