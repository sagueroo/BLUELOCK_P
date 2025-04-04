<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BioProfileController extends Controller
{

    public function updateProfilePhoto(Request $request)
    {
        $user = Auth::user();

        // Si l'image est envoyée sous forme de fichier classique (formulaire)
        if ($request->hasFile('profile_photo')) {
            $request->validate([
                'profile_photo' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($user->profile_photo_path && $user->profile_photo_path !== 'pictures/pop.png') {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $imagePath = $request->file('profile_photo')->store('profile_photos/' . $user->id, 'public');
            $user->profile_photo_path = $imagePath;
            $user->save();

            return back()->with('success', 'Photo de profil mise à jour !');
        }

        // Si l'image vient de Cropper.js en tant que blob
        if ($request->has('profile_photo')) {
            $image = $request->file('profile_photo');
            $filename = 'cropped_' . time() . '.jpg';
            $path = 'profile_photos/' . $user->id . '/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($image));
            $user->profile_photo_path = $path;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Aucune image reçue.'], 400);
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
