<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BioProfileController extends Controller
{

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // Delete older picture if exist
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Save the new picture
            $imagePath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $imagePath;
            $user->save();
        }

        return back()->with('success', 'Profile picture successfully updated!');
    }


    public function deleteProfilePhoto()
    {
        $user = Auth::user();
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = null;
            $user->save();
        }

        return back()->with('success', 'Profile picture successfully updated!');
    }
}
