<?php

namespace App\Http\Controllers;

use App\Models\User;


class FollowController extends Controller
{

    public function toggle(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id !== $user->id) { // Preventing you from following yourself
            $authUser->following()->toggle($user->id);
        }

        return back();
    }

    public function showFollowers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers()->get();
        return view('account.followers', compact('user', 'followers'));
    }

    public function showFollowing($id)
    {
       $user = User::findOrFail($id);
        $following = $user->following()->get();
        return view('account.following', compact('user', 'following'));
    }


}
