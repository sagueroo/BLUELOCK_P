<?php

namespace App\Http\Controllers;

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
}
