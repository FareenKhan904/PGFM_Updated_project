<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Course;
use App\Models\ClassItem;
use App\Models\ClassMaterial;
use App\Models\Enrollment;
use App\Models\LibraryItem;
use App\Models\News;
use App\Models\SliderImage;
use App\Models\Gallery;

class ChatbotController extends Controller
{
    /**
     * Get system context for the chatbot
     */
    private function getSystemContext()
    {
        $user = Auth::user();
        $context = [];
        
        // Get enrolled courses (filter out expired)
        $enrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->where('status', Enrollment::STATUS_ACCEPTED)
            ->get()
            ->reject(function ($enrollment) {
                return $enrollment->isExpired();
            });
        
        $context['courses'] = $enrollments->map(function($enrollment) {
            return [
                'title' => $enrollment->course->title,
                'description' => $enrollment->course->description,
                'id' => $enrollment->course->id,
            ];
        })->toArray();
        
        // Get classes for enrolled courses - only upcoming and today's classes
        $courseIds = $enrollments->pluck('course_id');
        $now = now();
        $startOfToday = $now->copy()->startOfDay();
        
        $classes = ClassItem::with('course')
            ->whereIn('course_id', $courseIds)
            ->where('is_active', true)
            ->where(function($query) use ($startOfToday) {
                // Include classes with no scheduled date OR scheduled for today or in the future
                $query->whereNull('scheduled_at')
                      ->orWhere('scheduled_at', '>=', $startOfToday);
            })
            ->orderBy('scheduled_at', 'asc')
            ->get();
        
        $context['classes'] = $classes->map(function($class) use ($now) {
            $isToday = $class->scheduled_at && $class->scheduled_at->isToday();
            $isUpcoming = $class->scheduled_at && $class->scheduled_at->isFuture();
            $hasPassed = $class->scheduled_at && $class->scheduled_at->isPast();
            
            return [
                'title' => $class->title,
                'description' => $class->description,
                'scheduled_at' => $class->scheduled_at?->format('Y-m-d H:i'),
                'scheduled_date' => $class->scheduled_at?->format('F d, Y'),
                'scheduled_time' => $class->scheduled_at?->format('h:i A'),
                'is_today' => $isToday && !$hasPassed,
                'is_upcoming' => $isUpcoming,
                'has_passed' => $hasPassed,
                'course_title' => $class->course->title,
            ];
        })->filter(function($class) use ($now) {
            // Filter out classes that have already passed today
            if ($class['has_passed'] && !$class['is_upcoming']) {
                return false;
            }
            return true;
        })->values()->toArray();
        
        // Get materials
        $classIds = $classes->pluck('id');
        $materials = ClassMaterial::whereIn('course_class_id', $classIds)
            ->where('is_active', true)
            ->get();
        
        $context['materials'] = $materials->map(function($material) {
            return [
                'title' => $material->title,
                'type' => $material->type,
                'description' => $material->description,
            ];
        })->toArray();
        
        // Get library items
        $libraryItems = LibraryItem::where('is_active', true)->get();
        $context['library'] = $libraryItems->map(function($item) {
            return [
                'title' => $item->title,
                'description' => $item->description,
                'type' => $item->type,
            ];
        })->toArray();
        
        // Get recent news
        $news = News::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        $context['news'] = $news->map(function($item) {
            return [
                'title' => $item->title,
                'content' => $item->content,
            ];
        })->toArray();
        
        // Get all public courses (for enrollment information)
        $publicCourses = Course::where('is_active', true)
            ->orderBy('title')
            ->get();
        
        $context['public_courses'] = $publicCourses->map(function($course) {
            return [
                'title' => $course->title,
                'description' => $course->description,
            ];
        })->toArray();
        
        // About page information
        $context['about'] = [
            'name' => 'Dr. Sahar Aslam',
            'title' => 'Consultant Family Medicine Specialist',
            'qualifications' => ['MCPS F.M (CPSP)', 'MRCGP [INT] RCGP-UK'],
            'achievements' => [
                'Cleared MRCGP INT on the first attempt',
                '99% passing success rate for MCPS & MRCGP INT students'
            ],
            'experience' => '14 years as a family physician',
            'current_position' => 'Consultant Family Medicine Specialist - Combined Military Hospital (CMH) Gilgit',
            'previous_positions' => [
                'Combined Military Hospital (CMH) Rawalpindi',
                'Pak-Emirates Military Hospital (PEMH) Rawalpindi',
                'Combined Military Hospital (CMH) Sialkot',
                'Indus Hospital Karachi'
            ],
            'global_reach' => ['Dubai', 'Saudi Arabia', 'Sri Lanka', 'Bangladesh', 'Pakistan'],
            'mission' => 'Enthusiastically working for growth, understanding, and primary care through family medicine in Pakistan'
        ];
        
        // Mentorship program information
        $context['mentorship'] = [
            'title' => 'Personalised Mentorship Program',
            'description' => 'Personalised one-to-one mentoring from Dr. Sahar Aslam',
            'features' => [
                'Structured Study Plans - Customized learning paths designed for your exam timeline and goals',
                'Station Feedback - Detailed feedback on OSCE stations and practice scenarios',
                'Progress Tracking - Monitor your improvement with regular assessments and reviews',
                'Guideline-Based Learning - Based on NICE and CPSP guidelines for accurate exam preparation'
            ],
            'success_rate' => '99%',
            'evidence_based' => true
        ];
        
        // Testimonials
        $context['testimonials'] = [
            [
                'quote' => 'I cleared on my first attempt… highly recommended!',
                'author' => 'MRCGP INT Candidate',
                'location' => 'Pakistan'
            ],
            [
                'quote' => 'Dr Sahar\'s notes alone helped me pass.',
                'author' => 'MRCGP INT Candidate',
                'location' => 'Dubai'
            ],
            [
                'quote' => 'Her motivation made all the difference.',
                'author' => 'Family Medicine Trainee',
                'location' => 'Saudi Arabia'
            ]
        ];
        
        // FAQ information
        $context['faq'] = [
            [
                'question' => 'Who is this course for?',
                'answer' => 'Doctors preparing for MRCGP INT South Asia (AKT & OSCE) and MCPS Family Medicine. Ideal for both first-time and repeat candidates.'
            ],
            [
                'question' => 'What does the course cover?',
                'answer' => 'Complete preparation for AKT and OSCE, including MCQs, clinical reasoning, communication skills, and primary care exam scenarios.'
            ],
            [
                'question' => 'How are classes delivered?',
                'answer' => 'Live online interactive sessions, MCQ discussions, OSCE walkthroughs, and active participation.'
            ],
            [
                'question' => 'Where is the study material available?',
                'answer' => 'All materials are uploaded to the official course website, including PDF notes, MCQ explanations, and OSCE frameworks.'
            ]
        ];
        
        // Contact information
        $context['contact'] = [
            'platform' => 'PGIFM - Postgraduate Family Institute of Medicine',
            'instructor' => 'Dr. Sahar Aslam',
            'note' => 'For inquiries, students can use the contact form on the website or reach out through the platform.'
        ];
        
        return $context;
    }
    
    /**
     * Build context prompt for Gemini
     */
    private function buildContextPrompt($context)
    {
        $prompt = "You are a helpful assistant for a medical education platform (PGIFM - Dr. Sahar Aslam). ";
        $prompt .= "You help students navigate their courses, classes, and learning materials. ";
        $prompt .= "IMPORTANT: Answer ONLY the specific question asked by the user. Do NOT provide unsolicited information or overviews. ";
        $prompt .= "Be concise and direct. Only use the following information when it's relevant to answer the user's question:\n\n";
        
        if (!empty($context['courses'])) {
            $prompt .= "ENROLLED COURSES:\n";
            foreach ($context['courses'] as $course) {
                $prompt .= "- {$course['title']}: {$course['description']}\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($context['classes'])) {
            $today = now()->format('F d, Y');
            $prompt .= "UPCOMING AND TODAY'S CLASSES (Current Date: {$today}):\n";
            foreach ($context['classes'] as $class) {
                $prompt .= "- {$class['title']} (Course: {$class['course_title']})";
                if ($class['description']) {
                    $prompt .= ": {$class['description']}";
                }
                if ($class['scheduled_at']) {
                    if ($class['is_today']) {
                        $prompt .= " - Scheduled TODAY at {$class['scheduled_time']}";
                    } elseif ($class['is_upcoming']) {
                        $prompt .= " - Scheduled: {$class['scheduled_date']} at {$class['scheduled_time']} (Upcoming)";
                    } else {
                        $prompt .= " - Scheduled: {$class['scheduled_date']} at {$class['scheduled_time']}";
                    }
                }
                $prompt .= "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($context['materials'])) {
            $prompt .= "LEARNING MATERIALS:\n";
            foreach ($context['materials'] as $material) {
                $prompt .= "- {$material['title']} ({$material['type']})";
                if ($material['description']) {
                    $prompt .= ": {$material['description']}";
                }
                $prompt .= "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($context['library'])) {
            $prompt .= "LIBRARY RESOURCES:\n";
            foreach ($context['library'] as $item) {
                $prompt .= "- {$item['title']} ({$item['type']})";
                if ($item['description']) {
                    $prompt .= ": {$item['description']}";
                }
                $prompt .= "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($context['news'])) {
            $prompt .= "RECENT NEWS:\n";
            foreach ($context['news'] as $item) {
                $prompt .= "- {$item['title']}: {$item['content']}\n";
            }
            $prompt .= "\n";
        }
        
        // Public site information
        if (!empty($context['public_courses'])) {
            $prompt .= "AVAILABLE PUBLIC COURSES (for enrollment):\n";
            foreach ($context['public_courses'] as $course) {
                $prompt .= "- {$course['title']}: {$course['description']}\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($context['about'])) {
            $about = $context['about'];
            $prompt .= "ABOUT DR. SAHAR ASLAM:\n";
            $prompt .= "- Name: {$about['name']}\n";
            $prompt .= "- Title: {$about['title']}\n";
            $prompt .= "- Qualifications: " . implode(', ', $about['qualifications']) . "\n";
            $prompt .= "- Experience: {$about['experience']}\n";
            $prompt .= "- Current Position: {$about['current_position']}\n";
            $prompt .= "- Success Rate: {$about['achievements'][1]}\n";
            $prompt .= "- Mission: {$about['mission']}\n";
            $prompt .= "\n";
        }
        
        if (!empty($context['mentorship'])) {
            $mentorship = $context['mentorship'];
            $prompt .= "MENTORSHIP PROGRAM:\n";
            $prompt .= "- {$mentorship['title']}: {$mentorship['description']}\n";
            $prompt .= "- Features:\n";
            foreach ($mentorship['features'] as $feature) {
                $prompt .= "  * {$feature}\n";
            }
            $prompt .= "- Success Rate: {$mentorship['success_rate']}\n";
            $prompt .= "\n";
        }
        
        if (!empty($context['testimonials'])) {
            $prompt .= "STUDENT TESTIMONIALS:\n";
            foreach ($context['testimonials'] as $testimonial) {
                $prompt .= "- \"{$testimonial['quote']}\" - {$testimonial['author']} ({$testimonial['location']})\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($context['faq'])) {
            $prompt .= "FREQUENTLY ASKED QUESTIONS (FAQ):\n";
            foreach ($context['faq'] as $faq) {
                $prompt .= "Q: {$faq['question']}\n";
                $prompt .= "A: {$faq['answer']}\n\n";
            }
        }
        
        if (!empty($context['contact'])) {
            $contact = $context['contact'];
            $prompt .= "CONTACT INFORMATION:\n";
            $prompt .= "- Platform: {$contact['platform']}\n";
            $prompt .= "- Instructor: {$contact['instructor']}\n";
            $prompt .= "- Note: {$contact['note']}\n";
            $prompt .= "\n";
        }
        
        $today = now()->format('F d, Y');
        $currentTime = now()->format('h:i A');
        
        $prompt .= "\nIMPORTANT CONTEXT:\n";
        $prompt .= "- Today's date is: {$today}\n";
        $prompt .= "- Current time is: {$currentTime}\n";
        $prompt .= "- Only classes scheduled for today or in the future are shown above.\n";
        $prompt .= "- Past classes are not included in the context.\n\n";
        
        $prompt .= "INSTRUCTIONS:\n";
        $prompt .= "- Answer ONLY what the user asks. Do NOT volunteer extra information.\n";
        $prompt .= "- If the user just says 'hello' or 'hi', respond with a brief greeting only (1-2 sentences max).\n";
        $prompt .= "- Be friendly, professional, and concise.\n";
        $prompt .= "- When mentioning classes, use the current date ({$today}) to determine if a class is 'today', 'upcoming', or 'past'.\n";
        $prompt .= "- If a class is scheduled for today, say 'today' not 'upcoming'.\n";
        $prompt .= "- If a class time has already passed today, it is in the past, not upcoming.\n";
        $prompt .= "- If you don't know something or the information isn't available, say so briefly.\n";
        $prompt .= "- Do NOT list all courses, classes, or materials unless specifically asked.\n\n";
        $prompt .= "User Question: ";
        
        return $prompt;
    }
    
    /**
     * Handle chatbot message
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        $apiKey = env('GEMINI_API_KEY');
        
        if (!$apiKey) {
            return response()->json([
                'error' => 'Chatbot API key not configured. Please set GEMINI_API_KEY in your .env file.'
            ], 500);
        }
        
        // Get system context
        $context = $this->getSystemContext();
        $contextPrompt = $this->buildContextPrompt($context);
        
        // Build full prompt with user message
        $fullPrompt = $contextPrompt . $request->message;
        
        try {
            // Try different Gemini API models in order of preference
            $models = ['gemini-3-flash-preview'];
            $response = null;
            $lastError = null;
            
            foreach ($models as $model) {
                try {
                    $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
                    
                    $requestBody = [
                        'contents' => [
                            [
                                'parts' => [
                                    [
                                        'text' => $fullPrompt
                                    ]
                                ]
                            ]
                        ],
                        'generationConfig' => [
                            'temperature' => 0.7,
                            'topK' => 40,
                            'topP' => 0.95,
                            'maxOutputTokens' => 1024,
                        ],
                    ];
                    
                    $response = Http::timeout(30)
                        ->withHeaders([
                            'Content-Type' => 'application/json',
                        ])
                        ->post($url, $requestBody);
                    
                    // If successful, break out of loop
                    if ($response->successful()) {
                        break;
                    } else {
                        $lastError = $response->body();
                        // If it's a 404, try next model
                        if ($response->status() === 404) {
                            continue;
                        }
                        // For other errors, break and handle
                        break;
                    }
                } catch (\Exception $e) {
                    $lastError = $e->getMessage();
                    continue;
                }
            }
            
            if (!$response) {
                throw new \Exception('Failed to connect to Gemini API. Please check your API key and internet connection.');
            }
            
            $statusCode = $response->status();
            $responseData = $response->json();
            
            if ($response->successful()) {
                // Check for response in different possible formats
                $reply = null;
                
                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    $reply = $responseData['candidates'][0]['content']['parts'][0]['text'];
                } elseif (isset($responseData['candidates'][0]['text'])) {
                    $reply = $responseData['candidates'][0]['text'];
                } elseif (isset($responseData[0]['candidates'][0]['content']['parts'][0]['text'])) {
                    $reply = $responseData[0]['candidates'][0]['content']['parts'][0]['text'];
                }
                
                if ($reply) {
                    return response()->json([
                        'success' => true,
                        'reply' => trim($reply),
                    ]);
                } else {
                    // Log the response for debugging
                    \Log::error('Gemini API - Unexpected response format', [
                        'response' => $responseData,
                        'status' => $statusCode
                    ]);
                    
                    return response()->json([
                        'error' => 'No response from AI. Please try again.',
                        'debug' => config('app.debug') ? $responseData : null
                    ], 500);
                }
            } else {
                // Log the error for debugging
                \Log::error('Gemini API Error', [
                    'status' => $statusCode,
                    'response' => $response->body(),
                    'url' => $url
                ]);
                
                $errorMessage = 'Failed to get response from AI.';
                
                if (isset($responseData['error'])) {
                    $errorMessage = $responseData['error']['message'] ?? $errorMessage;
                }
                
                return response()->json([
                    'error' => $errorMessage,
                    'details' => config('app.debug') ? $response->body() : null
                ], 500);
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            \Log::error('Gemini API Connection Error', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Connection error. Please check your internet connection and try again.'
            ], 500);
        } catch (\Exception $e) {
            \Log::error('Gemini API Exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'An error occurred: ' . ($e->getMessage()),
                'details' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }
}

