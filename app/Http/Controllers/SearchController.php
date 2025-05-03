<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sport;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $user = $user = Auth::user();
        $query = $request->input('q');

        // Use Scout to find anything
        $events = Event::search($query)->get();
        $posts = Post::search($query)->get();
        $users = User::search($query)->get();
        $sports = Sport::search($query)->get();

        //To know if the user is already registered with the sport (if the research find a sport)
        if ($user) {
            foreach ($sports as $sport) {
                $sport->isRegistered = $user->sports->contains('id', $sport->id);
            }
        } else {
            foreach ($sports as $sport) {
                $sport->isRegistered = false;
            }
        }
        return view('search.results', compact('events', 'query', 'posts', 'users', 'sports'));
    }
}


