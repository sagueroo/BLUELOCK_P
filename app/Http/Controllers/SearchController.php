<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->back()->with('error', 'Veuillez entrer une recherche.');
        }

        // Rechercher dans chaque modèle
        $events = Event::search($query)->get();
        $users = User::search($query)->get();
        $posts = Post::search($query)->get();

        return view('search.results', compact('query', 'posts', 'events', 'users'));
    }
}


