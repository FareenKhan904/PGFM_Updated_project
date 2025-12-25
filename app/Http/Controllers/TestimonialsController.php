<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TestimonialsController extends Controller
{
    public function index(): View
    {
        return view('testimonials');
    }
}



