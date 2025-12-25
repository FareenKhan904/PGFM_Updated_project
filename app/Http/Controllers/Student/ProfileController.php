<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the user profile
     */
    public function show(): View
    {
        $user = Auth::user();
        return view('student.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the profile
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('student.profile.edit', compact('user'));
    }

    /**
     * Update the user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        // Update name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Store new profile picture
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        // Update password if provided
        if (!empty($validated['password'])) {
            // Verify current password
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
            }
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('student.profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove profile picture
     */
    public function removePicture()
    {
        $user = Auth::user();

        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->profile_picture = null;
        $user->save();

        return redirect()->route('student.profile.edit')
            ->with('success', 'Profile picture removed successfully!');
    }
}
