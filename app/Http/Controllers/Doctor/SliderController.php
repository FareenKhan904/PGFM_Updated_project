<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    /**
     * Display a listing of the slider images
     */
    public function index(): View
    {
        try {
            // Use orderByRaw to handle reserved word 'order'
            $sliderImages = SliderImage::orderByRaw('`order` ASC')->get();
        } catch (\Exception $e) {
            // Fallback if there's an issue
            $sliderImages = SliderImage::latest()->get();
        }
        
        // Ensure we always have a collection
        if (!$sliderImages) {
            $sliderImages = collect();
        }
        
        return view('doctor.slider.index', compact('sliderImages'));
    }

    /**
     * Show the form for creating a new slider image
     */
    public function create(): View
    {
        return view('doctor.slider.create');
    }

    /**
     * Store a newly created slider image
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slider_images', 'public');
            $validated['image_path'] = $imagePath;
        }

        SliderImage::create([
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'image_path' => $validated['image_path'],
            'button_text' => $validated['button_text'] ?? null,
            'button_link' => $validated['button_link'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('doctor.slider.index')
            ->with('success', 'Slider image created successfully!');
    }

    /**
     * Show the form for editing the specified slider image
     */
    public function edit(SliderImage $sliderImage): View
    {
        return view('doctor.slider.edit', compact('sliderImage'));
    }

    /**
     * Update the specified slider image
     */
    public function update(Request $request, SliderImage $sliderImage)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($sliderImage->image_path && Storage::disk('public')->exists($sliderImage->image_path)) {
                Storage::disk('public')->delete($sliderImage->image_path);
            }
            $imagePath = $request->file('image')->store('slider_images', 'public');
            $validated['image_path'] = $imagePath;
        }

        $sliderImage->update($validated);

        return redirect()->route('doctor.slider.index')
            ->with('success', 'Slider image updated successfully!');
    }

    /**
     * Remove the specified slider image
     */
    public function destroy(SliderImage $sliderImage)
    {
        // Delete image file
        if ($sliderImage->image_path && Storage::disk('public')->exists($sliderImage->image_path)) {
            Storage::disk('public')->delete($sliderImage->image_path);
        }

        $sliderImage->delete();

        return redirect()->route('doctor.slider.index')
            ->with('success', 'Slider image deleted successfully!');
    }
}
