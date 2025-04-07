<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdminController extends Controller
{
    public function dashboard()
    {
        $posts = Post::with('user')->latest()->get(); // Récupère tous les posts
        return view('admin.dashboard', compact('posts'));
    }

    public function deletePost(Post $post)
    {
        // TODO Optionnel : supprimer aussi l'image s'il y en a une


        $post->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Post supprimé avec succès.');
    }
}
