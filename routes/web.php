<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\MentorshipController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\Doctor\CoursesController as DoctorCoursesController;
use App\Http\Controllers\Doctor\NewsController as DoctorNewsController;
use App\Http\Controllers\Doctor\ClassesController as DoctorClassesController;
use App\Http\Controllers\Doctor\MentorshipController as DoctorMentorshipController;
use App\Http\Controllers\Doctor\SliderController as DoctorSliderController;
use App\Http\Controllers\Doctor\GalleryController as DoctorGalleryController;
use App\Http\Controllers\Doctor\ProfileController as DoctorProfileController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\CoursesController as StudentCoursesController;
use App\Http\Controllers\Student\ClassesController as StudentClassesController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Doctor\EnrollmentController as DoctorEnrollmentController;
use App\Http\Controllers\Doctor\ClassMaterialController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ChatbotController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Public pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
Route::get('/mentorship', [MentorshipController::class, 'index'])->name('mentorship');
Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Library - Only authenticated students and doctors can access
Route::get('/library', [LibraryController::class, 'index'])
    ->middleware('auth')
    ->name('library.index');

// Enrollment - Only authenticated students can enroll
Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])
    ->middleware('auth')
    ->name('enroll.store');

// Enrollment by course title (for static course pages)
Route::post('/courses/enroll-by-title', [EnrollmentController::class, 'enrollByTitle'])
    ->middleware('auth')
    ->name('enroll.by-title');

// Video streaming - Accessible to authenticated students and doctors
Route::get('/video/{material}/stream', [VideoController::class, 'stream'])
    ->middleware('auth')
    ->name('video.stream');

// Material file download - Accessible to authenticated students and doctors
Route::get('/material/{material}/download', [VideoController::class, 'download'])
    ->middleware('auth')
    ->name('material.download');

// Chatbot - Only for authenticated students
Route::post('/chatbot/chat', [ChatbotController::class, 'chat'])
    ->middleware('auth')
    ->name('chatbot.chat');

Auth::routes();

// After login – shows correct dashboard view (your HomeController logic)
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// Student area – ONLY students (type = 1) can access
Route::prefix('student')->middleware(['auth', 'role:1'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('student.dashboard');
    
    // Courses - View enrolled courses
    Route::get('courses', [StudentCoursesController::class, 'index'])->name('student.courses.index');
    
    // Classes and Materials - View classes for enrolled courses
    Route::get('classes', [StudentClassesController::class, 'index'])->name('student.classes.index');
    Route::get('classes/{class}/materials', [StudentClassesController::class, 'showMaterials'])->name('student.classes.materials');
    
    // Profile Management
    Route::get('profile', [StudentProfileController::class, 'show'])->name('student.profile.show');
    Route::get('profile/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::put('profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::delete('profile/picture', [StudentProfileController::class, 'removePicture'])->name('student.profile.removePicture');
});

// Doctor area – ONLY doctors (type = 2) can access
Route::prefix('doctor')->middleware(['auth', 'role:2'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('doctor.dashboard');
    
    // Courses - CRUD
    Route::get('courses', [DoctorCoursesController::class, 'index'])->name('doctor.courses.index');
    Route::get('courses/create', [DoctorCoursesController::class, 'create'])->name('doctor.courses.create');
    Route::post('courses', [DoctorCoursesController::class, 'store'])->name('doctor.courses.store');
    Route::get('courses/{course}/edit', [DoctorCoursesController::class, 'edit'])->name('doctor.courses.edit');
    Route::put('courses/{course}', [DoctorCoursesController::class, 'update'])->name('doctor.courses.update');
    Route::delete('courses/{course}', [DoctorCoursesController::class, 'destroy'])->name('doctor.courses.destroy');
    
    // Enrollment Requests Management
    Route::get('enrollments', [DoctorEnrollmentController::class, 'index'])->name('doctor.enrollments.index');
    Route::put('enrollments/{enrollment}', [DoctorEnrollmentController::class, 'update'])->name('doctor.enrollments.update');
    
    // News - CRUD
    Route::get('news', [DoctorNewsController::class, 'index'])->name('doctor.news.index');
    Route::get('news/create', [DoctorNewsController::class, 'create'])->name('doctor.news.create');
    Route::post('news', [DoctorNewsController::class, 'store'])->name('doctor.news.store');
    Route::get('news/{news}/edit', [DoctorNewsController::class, 'edit'])->name('doctor.news.edit');
    Route::put('news/{news}', [DoctorNewsController::class, 'update'])->name('doctor.news.update');
    Route::delete('news/{news}', [DoctorNewsController::class, 'destroy'])->name('doctor.news.destroy');
    
    // Classes - CRUD
    Route::get('classes', [DoctorClassesController::class, 'index'])->name('doctor.classes.index');
    Route::get('classes/create', [DoctorClassesController::class, 'create'])->name('doctor.classes.create');
    Route::post('classes', [DoctorClassesController::class, 'store'])->name('doctor.classes.store');
    Route::get('classes/{class}/edit', [DoctorClassesController::class, 'edit'])->name('doctor.classes.edit');
    Route::put('classes/{class}', [DoctorClassesController::class, 'update'])->name('doctor.classes.update');
    Route::delete('classes/{class}', [DoctorClassesController::class, 'destroy'])->name('doctor.classes.destroy');
    
    // Class Materials - CRUD
    Route::get('classes/{class}/materials', [ClassMaterialController::class, 'index'])->name('doctor.class-materials.index');
    Route::get('classes/{class}/materials/create', [ClassMaterialController::class, 'create'])->name('doctor.class-materials.create');
    Route::post('classes/{class}/materials', [ClassMaterialController::class, 'store'])->name('doctor.class-materials.store');
    Route::get('classes/{class}/materials/{material}/edit', [ClassMaterialController::class, 'edit'])->name('doctor.class-materials.edit');
    Route::put('classes/{class}/materials/{material}', [ClassMaterialController::class, 'update'])->name('doctor.class-materials.update');
    Route::delete('classes/{class}/materials/{material}', [ClassMaterialController::class, 'destroy'])->name('doctor.class-materials.destroy');
    
    // Mentorship
    Route::get('mentorship', [DoctorMentorshipController::class, 'index'])->name('doctor.mentorship.index');
    
    // Library Management
    Route::get('library', [LibraryController::class, 'manage'])->name('library.manage');
    Route::get('library/create', [LibraryController::class, 'create'])->name('library.create');
    Route::post('library', [LibraryController::class, 'store'])->name('library.store');
    Route::get('library/{libraryItem}/edit', [LibraryController::class, 'edit'])->name('library.edit');
    Route::put('library/{libraryItem}', [LibraryController::class, 'update'])->name('library.update');
    Route::delete('library/{libraryItem}', [LibraryController::class, 'destroy'])->name('library.destroy');
    
    // Website Management - Slider Images
    Route::get('slider', [DoctorSliderController::class, 'index'])->name('doctor.slider.index');
    Route::get('slider/create', [DoctorSliderController::class, 'create'])->name('doctor.slider.create');
    Route::post('slider', [DoctorSliderController::class, 'store'])->name('doctor.slider.store');
    Route::get('slider/{sliderImage}/edit', [DoctorSliderController::class, 'edit'])->name('doctor.slider.edit');
    Route::put('slider/{sliderImage}', [DoctorSliderController::class, 'update'])->name('doctor.slider.update');
    Route::delete('slider/{sliderImage}', [DoctorSliderController::class, 'destroy'])->name('doctor.slider.destroy');
    
    // Website Management - Gallery
    Route::get('gallery', [DoctorGalleryController::class, 'index'])->name('doctor.gallery.index');
    Route::get('gallery/create', [DoctorGalleryController::class, 'create'])->name('doctor.gallery.create');
    Route::post('gallery', [DoctorGalleryController::class, 'store'])->name('doctor.gallery.store');
    Route::get('gallery/{gallery}/edit', [DoctorGalleryController::class, 'edit'])->name('doctor.gallery.edit');
    Route::put('gallery/{gallery}', [DoctorGalleryController::class, 'update'])->name('doctor.gallery.update');
    Route::delete('gallery/{gallery}', [DoctorGalleryController::class, 'destroy'])->name('doctor.gallery.destroy');
    
    // Profile Management
    Route::get('profile', [DoctorProfileController::class, 'show'])->name('doctor.profile.show');
    Route::get('profile/edit', [DoctorProfileController::class, 'edit'])->name('doctor.profile.edit');
    Route::put('profile', [DoctorProfileController::class, 'update'])->name('doctor.profile.update');
    Route::delete('profile/picture', [DoctorProfileController::class, 'removePicture'])->name('doctor.profile.removePicture');
});