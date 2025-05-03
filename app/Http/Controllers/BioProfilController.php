<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BioProfilController extends Controller
{
    public function updateBio(Request $request)
    {
        $request->validate([
            'bio' => 'required|string|max:200',
        ]);

        $user = Auth::user();
        $user->bio = $request->bio;
        $user->save();

        return redirect()->route('account.show')->with('success', 'Your bio has been successfully updated!');
    }

}
