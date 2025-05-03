<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UsersSportsController
{
    public function addSport(Request $request)
    {
        $user = Auth::user();
        $sport = Sport::find($request->sport_id);
        $user->sports()->attach($sport);

        return back()->with('success', 'Sport added successfully !');
    }

    public function deleteSport(Request $request)
    {
        $user = Auth::user();
        $sport = Sport::find($request->sport_id);

        if ($sport) {
            // Delete all posts of the user linked with this sport
            $user->posts()->where('sport_id', $sport->id)->delete();
            $user->sports()->detach($sport->id);

            return back()->with('success', 'Sport and posts delete successfully !');
        }
        return back()->with('error', 'Sport not found');
    }


}
