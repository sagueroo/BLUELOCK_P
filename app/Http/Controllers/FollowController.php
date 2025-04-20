<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{

    public function toggle(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id !== $user->id) { // Empêcher de se suivre soi-même
            $authUser->following()->toggle($user->id);
        }

        return back();
    }

    public function showFollowers(User $user)
    {
       // $user = User::findOrFail($id);
        $followers = $user->followers()->get();
        return view('followers', compact('user', 'followers'));
    }

    public function showFollowing(User $user)
    {
       // $user = User::findOrFail($id);
        $following = $user->following()->get();
        return view('following', compact('user', 'following'));
    }


}
