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

        // Ajouter le sport à l'utilisateur
        $user->sports()->attach($sport);

        return back()->with('success', 'Sport ajouté avec succès !');
    }

    public function deleteSport(Request $request)
    {
        $user = Auth::user();
        $sport = Sport::find($request->sport_id);

        if ($sport) {
            $user->sports()->detach($sport->id);
            return back()->with('success', 'Sport retiré avec succès !');
        }

        return back()->with('error', 'Sport non trouvé.');
    }

}
