<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'contenu' => 'required|string|max:500',
            'sport_id' => 'required|exists:sports,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }


        Post::create([
            'user_id' => auth()->id(),
            'sport_id' => $request->get('sport_id'),
            'content' => $request->contenu,
            'image_path' => $imagePath,

        ]);

        return redirect()->back()->with('success', 'Post created successfully.');
    }

    public function index()
    {
        // Retrieve all posts
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('posts'));
    }

    public function deletePost(Post $post)
    {
        // Check that the post belongs to the logged-in user
        if ($post->user_id !== auth()->id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        // TODO Delete image if exist


        $post->delete();
        return back()->with('success', 'Post delete successfully.');
    }

}
