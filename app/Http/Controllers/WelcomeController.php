<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\News;
use App\Models\SliderImage;
use App\Models\Gallery;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        // Initialize default values in case database is not available
        $courses = collect();
        $classesNews = collect();
        $referenceNews = collect();
        $news = collect();
        $latestNews = null;
        $sliderImages = collect();
        $galleries = collect();
        $enrollments = collect();
        
        try {
            $courses = Course::where('is_active', true)
                ->latest()
                ->take(6)
                ->get();
            
            // Get classes news (type = 0)
            $classesNews = News::where('is_published', true)
                ->where('type', 0)
                ->latest()
                ->take(6)
                ->get();
            
            // Get reference news (type = 1)
            $referenceNews = News::where('is_published', true)
                ->where('type', 1)
                ->latest()
                ->take(6)
                ->get();
            
            // Get all news for backward compatibility
            $news = News::where('is_published', true)
                ->latest()
                ->take(6)
                ->get();
            
            // Get the latest news item for popup
            $latestNews = News::where('is_published', true)
                ->latest()
                ->first();
            
            // Get active slider images ordered by display order
            $sliderImages = SliderImage::where('is_active', true)
                ->orderBy('order')
                ->get();
            
            // Get active gallery items ordered by display order
            $galleries = Gallery::where('is_active', true)
                ->orderBy('order')
                ->latest()
                ->get();
            
            // Get user enrollments if authenticated
            if (Auth::check()) {
                $enrollments = Enrollment::where('user_id', Auth::id())
                    ->pluck('course_id')
                    ->toArray();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Database connection failed - use empty collections
            // Log the error but don't break the page
            \Log::warning('Database connection failed on welcome page: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Any other exception - use empty collections
            \Log::warning('Error loading welcome page data: ' . $e->getMessage());
        }
        
        return view('welcome', compact('courses', 'news', 'classesNews', 'referenceNews', 'latestNews', 'sliderImages', 'galleries', 'enrollments'));
    }
}