<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Redirection vers Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback après l'authentification Google
    public function handleGoogleCallback()
    {

        $googleUser = Socialite::driver('google')->stateless()->user();
        // Vérifier si getAvatar() retourne une URL ou null


        // Vérifie si l'utilisateur existe déjà dans la base de données
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            $avatarUrl = $googleUser->getAvatar();

            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'profile_photo_path' => $avatarUrl, // Utiliser soit l'avatar Google, soit l'image par défaut
                'password' => bcrypt(uniqid()),
            ]);
        }


        // Connecter l'utilisateur
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Connexion réussie !');

    }
}
