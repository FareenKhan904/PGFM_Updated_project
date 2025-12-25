<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of the news items
     */
    public function index(): View
    {
        $news = News::where('user_id', Auth::id())->latest()->paginate(10);
        return view('doctor.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new news item
     */
    public function create(): View
    {
        return view('doctor.news.create');
    }

    /**
     * Store a newly created news item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|integer|in:0,1',
            'is_published' => 'boolean',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'type' => $validated['type'],
            'is_published' => $request->has('is_published') ? true : false,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('doctor.news.index')
            ->with('success', 'News item created successfully!');
    }

    /**
     * Show the form for editing the specified news item
     */
    public function edit(News $news): View
    {
        // Ensure the news item belongs to the authenticated doctor
        if ((int)$news->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('doctor.news.edit', compact('news'));
    }

    /**
     * Update the specified news item
     */
    public function update(Request $request, News $news)
    {
        // Ensure the news item belongs to the authenticated doctor
        if ((int)$news->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|integer|in:0,1',
            'is_published' => 'boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'type' => $validated['type'],
            'is_published' => $request->has('is_published') ? true : false,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('doctor.news.index')
            ->with('success', 'News item updated successfully!');
    }

    /**
     * Remove the specified news item
     */
    public function destroy(News $news)
    {
        // Ensure the news item belongs to the authenticated doctor
        if ((int)$news->user_id !== (int)Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image if exists
        if ($news->image) {
            \Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('doctor.news.index')
            ->with('success', 'News item deleted successfully!');
    }
}
