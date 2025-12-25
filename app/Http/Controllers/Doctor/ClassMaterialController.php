<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClassItem;
use App\Models\ClassMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ClassMaterialController extends Controller
{
    /**
     * Display materials for a specific class
     */
    public function index(ClassItem $class)
    {
        // Verify class belongs to the doctor
        if ((int)$class->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $materials = ClassMaterial::where('course_class_id', $class->id)
            ->orderBy('order')
            ->latest()
            ->get();

        return view('doctor.class-materials.index', compact('class', 'materials'));
    }

    /**
     * Show the form for creating a new material
     */
    public function create(ClassItem $class): View
    {
        // Verify class belongs to the doctor
        if ((int)$class->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('doctor.class-materials.create', compact('class'));
    }

    /**
     * Store a newly created material
     */
    public function store(Request $request, ClassItem $class)
    {
        // Verify class belongs to the doctor
        if ((int)$class->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'type' => 'required|in:pdf,video,link,document,other',
            'file' => 'nullable|file|mimes:pdf,doc,docx,mp4,avi,mov,mp3|max:102400', // 100MB max
            'external_link' => 'nullable|url|max:500',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $filePath = null;
        $fileName = null;
        $fileSize = null;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $filePath = $file->store('class-materials', 'public');
        }

        // Ensure either file or external_link is provided
        if (!$filePath && !$request->external_link) {
            return back()->with('error', 'Please provide either a file or external link.');
        }

        ClassMaterial::create([
            'course_class_id' => $class->id,
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'external_link' => $validated['external_link'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('doctor.class-materials.index', $class)
            ->with('success', 'Material added successfully!');
    }

    /**
     * Show the form for editing the specified material
     */
    public function edit(ClassItem $class, ClassMaterial $material): View
    {
        // Verify class and material belong to the doctor
        if ((int)$class->user_id !== (int)Auth::id() || (int)$material->course_class_id !== (int)$class->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('doctor.class-materials.edit', compact('class', 'material'));
    }

    /**
     * Update the specified material
     */
    public function update(Request $request, ClassItem $class, ClassMaterial $material)
    {
        // Verify class and material belong to the doctor
        if ((int)$class->user_id !== (int)Auth::id() || (int)$material->course_class_id !== (int)$class->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'type' => 'required|in:pdf,video,link,document,other',
            'file' => 'nullable|file|mimes:pdf,doc,docx,mp4,avi,mov,mp3|max:102400',
            'external_link' => 'nullable|url|max:500',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $filePath = $material->file_path;
        $fileName = $material->file_name;
        $fileSize = $material->file_size;

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $filePath = $file->store('class-materials', 'public');
        }

        $material->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'external_link' => $validated['external_link'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('doctor.class-materials.index', $class)
            ->with('success', 'Material updated successfully!');
    }

    /**
     * Remove the specified material
     */
    public function destroy(ClassItem $class, ClassMaterial $material)
    {
        // Verify class and material belong to the doctor
        if ((int)$class->user_id !== (int)Auth::id() || (int)$material->course_class_id !== (int)$class->id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete file if exists
        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->route('doctor.class-materials.index', $class)
            ->with('success', 'Material deleted successfully!');
    }
}
