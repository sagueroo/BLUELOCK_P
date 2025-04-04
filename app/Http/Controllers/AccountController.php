<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use App\Models\Post;

class AccountController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté

        // Compter les abonnés (followers)
        $followersCount = Follower::where('following_id', $user->id)->count();

        // Compter les abonnements (following)
        $followingCount = Follower::where('follower_id', $user->id)->count();

        // Compter les publications
        $postsCount = Post::where('user_id', $user->id)->count();

        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();


        return view('account.account', compact('user', 'followersCount', 'followingCount', 'postsCount','posts'));
    }
}
