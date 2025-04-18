<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use App\Models\User;
use JetBrains\PhpStorm\NoReturn;

class AdminController extends Controller
{
    public function dashboard()
    {
        $posts = Post::with('user')->latest()->get();
        $users = \App\Models\User::all();
        $events = \App\Models\Event::all();
        return view('admin.dashboard', compact('posts', 'users', 'events'));
    }


    public function deletePost(Post $post)
    {
        $post->delete();
        return view('admin.dashboard')->with('success', 'Post supprimé avec succès.');
    }
    public function deleteEvent(Event $event) {
        $event->delete();
        return view('admin.dashboard')->with('success', 'Événement supprimé avec succès.');
    }

    public function deleteUser(User $user)
    {
        $user->events()->delete();
        $user->posts()->delete();
        $user->delete();

        return view('admin.dashboard')->with('success', 'Utilisateur supprimé avec succès.');
    }

}
