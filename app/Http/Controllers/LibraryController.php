<?php

namespace App\Http\Controllers;

use App\Models\LibraryItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LibraryController extends Controller
{
    /**
     * Display the library listing (only for authenticated students and doctors)
     */
    public function index(Request $request): View
    {
        // Ensure only students and doctors can access
        $user = Auth::user();
        if ($user->type !== User::TYPE_STUDENT && $user->type !== User::TYPE_DOCTOR) {
            abort(403, 'Access denied. Only registered students and doctors can access the library.');
        }

        $query = LibraryItem::with('user')->active()->latest();

        // Filter by type if provided
        if ($request->has('type') && $request->type) {
            $query->ofType($request->type);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(12);

        return view('library.index', compact('items'));
    }

    /**
     * Display the doctor's library management page
     */
    public function manage(): View
    {
        $items = LibraryItem::where('user_id', Auth::id())->latest()->paginate(15);
        return view('library.manage', compact('items'));
    }

    /**
     * Show the form for creating a new library item
     */
    public function create(): View
    {
        return view('library.create');
    }

    /**
     * Store a newly created library item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'type' => 'required|in:book,article,document,video,other',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:10240', // 10MB max
            'external_link' => 'nullable|url|max:500',
        ]);

        // Ensure either file or external_link is provided
        if (!$request->hasFile('file') && !$request->external_link) {
            return back()->withErrors(['file' => 'Either a file or external link must be provided.'])->withInput();
        }

        $data = [
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'author' => $validated['author'] ?? null,
            'publisher' => $validated['publisher'] ?? null,
            'year' => $validated['year'] ?? null,
            'external_link' => $validated['external_link'] ?? null,
            'is_active' => true,
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('library', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        LibraryItem::create($data);

        return redirect()->route('library.manage')->with('success', 'Library item uploaded successfully!');
    }

    /**
     * Show the form for editing a library item
     */
    public function edit(LibraryItem $libraryItem): View
    {
        // Ensure only the owner can edit
        if ($libraryItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('library.edit', compact('libraryItem'));
    }

    /**
     * Update the specified library item
     */
    public function update(Request $request, LibraryItem $libraryItem)
    {
        // Ensure only the owner can update
        if ($libraryItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'type' => 'required|in:book,article,document,video,other',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:10240',
            'external_link' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'author' => $validated['author'] ?? null,
            'publisher' => $validated['publisher'] ?? null,
            'year' => $validated['year'] ?? null,
            'external_link' => $validated['external_link'] ?? null,
            'is_active' => $request->has('is_active'),
        ];

        // Handle new file upload (replaces old file)
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($libraryItem->file_path && Storage::disk('public')->exists($libraryItem->file_path)) {
                Storage::disk('public')->delete($libraryItem->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('library', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        $libraryItem->update($data);

        return redirect()->route('library.manage')->with('success', 'Library item updated successfully!');
    }

    /**
     * Remove the specified library item
     */
    public function destroy(LibraryItem $libraryItem)
    {
        // Ensure only the owner can delete
        if ($libraryItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete file if exists
        if ($libraryItem->file_path && Storage::disk('public')->exists($libraryItem->file_path)) {
            Storage::disk('public')->delete($libraryItem->file_path);
        }

        $libraryItem->delete();

        return redirect()->route('library.manage')->with('success', 'Library item deleted successfully!');
    }
}
