<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use App\Models\Post;
use App\Models\Sport;

class AccountController extends Controller
{
    public function show($id = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Check if an ID is provided, otherwise display the profile of the logged-in user
        $user = $id ? User::findOrFail($id) : Auth::user();

        // Check whether the logged-in user is viewing his own profile
        $isOwnProfile = (Auth::id() == $user->id);

        // Retrieve all posts and followers of the user connected
        $followersCount = Follower::where('following_id', $user->id)->count();
        $followingCount = Follower::where('follower_id', $user->id)->count();
        $postsCount = Post::where('user_id', $user->id)->count();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();


        // Show account.blade.php if the user is the user connected
        if ($isOwnProfile) {
            return view('account.account', compact('user', 'isOwnProfile', 'followersCount', 'followingCount', 'postsCount', 'posts'));
        }

        // Else, show viewprofile.blade.php for a other user
        return view('account.viewaccount', compact('user', 'isOwnProfile', 'followersCount', 'followingCount', 'postsCount', 'posts'));
    }

    public function follow($id)
    {
        $currentUser = Auth::user();
        $userToFollow = User::findOrFail($id);

        // Check if the user is not already subscribed
        $alreadyFollowing = Follower::where('follower_id', $currentUser->id)
            ->where('following_id', $userToFollow->id)
            ->exists();

        if (!$alreadyFollowing) {
            // Add in the table
            Follower::create([
                'follower_id' => $currentUser->id,
                'following_id' => $userToFollow->id,
            ]);
        }

        return redirect()->back()->with('success', 'You follow now' . $userToFollow->name);
    }

    public function unfollow($id)
    {
        $currentUser = Auth::user();
        $userToUnfollow = User::findOrFail($id);

        // Delete in the table
        Follower::where('follower_id', $currentUser->id)
            ->where('following_id', $userToUnfollow->id)
            ->delete();

        return redirect()->back()->with('success', 'You dont follow now' . $userToUnfollow->name);
    }


}
