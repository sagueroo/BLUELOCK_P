<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    // Join a club
    public function join($id)
    {
        $user = Auth::user();

        if ($user->club_id) {
            $currentClub = $user->club->name ?? 'Unknown';
            return redirect()->back()->with('error', 'You are already in a club.');
        }

        $club = Club::firstOrCreate(
            ['api_id' => $id],
            [
                'name' => request('name'),
                'badge' => request('badge')
            ]
        );

        $user->club_id = $club->id;
        $user->save();

        return redirect()->back()->with('success', 'You have joined the club: ' . $club->name);
    }

    // Leave a club
    public function toggle($id)
    {
        $user = Auth::user();

        if ($user->club && $user->club->api_id == $id) {
            $user->club_id = null;
            $user->save();
            return redirect()->back()->with('success', 'You have left the club.');
        }

        // Same logic if not possible
        return redirect()->back()->with('error', 'Unable to leave this club.');
    }

    // View club members
    public function members($id)
    {
        $club = Club::with('users')->findOrFail($id);
        return view('clubs.members', compact('club'));
    }

    // View club players
    public function players($id)
    {
        $club = Club::where('api_id', $id)->firstOrFail();
        $members = $club->users()->paginate(20); // Display 20 members per page

        return view('clubs.players', compact('club', 'members'));
    }
}
