<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use App\Models\Sport;
use Illuminate\Support\Facades\Auth;

class SportController extends Controller
{
    public function showSport(){
        $sports = Sport::all();
        $user = Auth::user();

        if ($user) {
            foreach ($sports as $sport) {
                $sport->isRegistered = $user->sports->contains('id', $sport->id);
            }
        } else {
            foreach ($sports as $sport) {
                $sport->isRegistered = false;
            }
        }
        return view('bluesport', compact('sports'));
    }

}
