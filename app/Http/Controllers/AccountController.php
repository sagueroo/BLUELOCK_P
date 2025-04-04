<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use App\Models\Post;
use App\Models\Sport; // Assure-toi d'importer le modèle Sport

class AccountController extends Controller
{
    public function show($id = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Vérifier si un ID est fourni, sinon afficher le profil de l'utilisateur connecté
        $user = $id ? User::findOrFail($id) : Auth::user();

        // Vérifier si l'utilisateur connecté est en train de voir son propre profil
        $isOwnProfile = (Auth::id() == $user->id);

        // Récupérer les statistiques
        $followersCount = Follower::where('following_id', $user->id)->count();
        $followingCount = Follower::where('follower_id', $user->id)->count();
        $postsCount = Post::where('user_id', $user->id)->count();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();


        // Afficher `account.blade.php` si c'est le profil de l'utilisateur connecté
        if ($isOwnProfile) {
            return view('account.account', compact('user', 'isOwnProfile', 'followersCount', 'followingCount', 'postsCount', 'posts'));
        }

        // Sinon, afficher `viewprofile.blade.php` pour un autre utilisateur
        return view('account.viewaccount', compact('user', 'isOwnProfile', 'followersCount', 'followingCount', 'postsCount', 'posts'));
    }

    public function follow($id)
    {
        $currentUser = Auth::user();
        $userToFollow = User::findOrFail($id);

        // Vérifier si l'utilisateur n'est pas déjà suivi
        $alreadyFollowing = Follower::where('follower_id', $currentUser->id)
            ->where('following_id', $userToFollow->id)
            ->exists();

        if (!$alreadyFollowing) {
            // Ajouter l'entrée dans la table followers
            Follower::create([
                'follower_id' => $currentUser->id,
                'following_id' => $userToFollow->id,
            ]);
        }

        return redirect()->back()->with('success', 'Vous suivez maintenant ' . $userToFollow->name);
    }

    public function unfollow($id)
    {
        $currentUser = Auth::user();
        $userToUnfollow = User::findOrFail($id);

        // Supprimer l'entrée de la table followers
        Follower::where('follower_id', $currentUser->id)
            ->where('following_id', $userToUnfollow->id)
            ->delete();

        return redirect()->back()->with('success', 'Vous ne suivez plus ' . $userToUnfollow->name);
    }


}
