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
            // Supprimer l'ancienne photo si elle existe
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Sauvegarder la nouvelle photo
            $imagePath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $imagePath;
            $user->save();
        }

        return back()->with('success', 'Photo de profil mise à jour avec succès !');
    }

    // 🗑️ Méthode pour supprimer la photo
    public function deleteProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = null;
            $user->save();
        }

        return back()->with('success', 'Photo de profil supprimée avec succès !');
    }
}
