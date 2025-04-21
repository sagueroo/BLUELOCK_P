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

        // Utilise Scout pour chercher
        $events = Event::search($query)->get();
        $posts = Post::search($query)->get();
        $users = User::search($query)->get();
        $sports = Sport::search($query)->get();

        //Repris du controller SportController (permettant de savoir un l'user est déjà enregistré dans le sport pour le bouton)
        if ($user) {
            foreach ($sports as $sport) {
                $sport->isRegistered = $user->sports->contains('id', $sport->id);
            }
        } else {
            foreach ($sports as $sport) {
                $sport->isRegistered = false; // Par défaut, non inscrit si l'utilisateur est déconnecté
            }
        }

        return view('search.results', compact('events', 'query', 'posts', 'users', 'sports'));
    }
}


