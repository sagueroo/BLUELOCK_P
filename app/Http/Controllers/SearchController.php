<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sport;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Utilise Scout pour chercher
        $events = Event::search($query)->get();
        $posts = Post::search($query)->get();
        $users = User::search($query)->get();
        $sports = Sport::search($query)->get();

        return view('search.results', compact('events', 'query', 'posts', 'users', 'sports'));
    }
}


