<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the gallery items
     */
    public function index(): View
    {
        $galleries = Gallery::where('user_id', Auth::id())
            ->orderByRaw('`order` ASC')
            ->latest()
            ->get();
        
        return view('doctor.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery item
     */
    public function create(): View
    {
        return view('doctor.gallery.create');
    }

    /**
     * Store a newly created gallery item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = $imagePath;
        }

        Gallery::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'image_path' => $validated['image_path'],
            'order' => $validated['order'] ?? 0,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('doctor.gallery.index')
            ->with('success', 'Gallery item created successfully!');
    }

    /**
     * Show the form for editing the specified gallery item
     */
    public function edit(Gallery $gallery): View
    {
        // Ensure the gallery item belongs to the authenticated doctor
        if ((int)$gallery->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('doctor.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery item
     */
    public function update(Request $request, Gallery $gallery)
    {
        // Ensure the gallery item belongs to the authenticated doctor
        if ((int)$gallery->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $imagePath = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = $imagePath;
        }

        $gallery->update($validated);

        return redirect()->route('doctor.gallery.index')
            ->with('success', 'Gallery item updated successfully!');
    }

    /**
     * Remove the specified gallery item
     */
    public function destroy(Gallery $gallery)
    {
        // Ensure the gallery item belongs to the authenticated doctor
        if ((int)$gallery->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image file
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('doctor.gallery.index')
            ->with('success', 'Gallery item deleted successfully!');
    }
}


