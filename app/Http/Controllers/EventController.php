<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Event;

class EventController
{
    public function showEvent()
    {
        // Récupère l'utilisateur actuellement authentifié
        $user = auth()->user();

        // Récupère les sports auxquels l'utilisateur est inscrit (avec leurs informations complètes)
        $sportsSubscribed = $user->sports;  // Retirer le pluck('id') pour récupérer les objets complets

        // Récupère les événements associés à ces sports et charge les relations sport et user
        $events = Event::with('sport', 'user')  // 'sport' pour récupérer le sport lié à l'événement, 'user' pour récupérer l'utilisateur qui a créé l'événement
        ->whereIn('sport_id', $sportsSubscribed->pluck('id'))  // Filtre par les sports auxquels l'utilisateur est inscrit
        ->get();

        // Calcul du nombre de places restantes pour chaque événement
        foreach ($events as $event) {
            $event->place_prises = $event->users->count();
        }

        return view('blueevent', compact('events', 'sportsSubscribed'));
    }


    public function joinEvent(Event $event)
    {
        $user = auth()->user();

        if (!$user) {
            return back()->with('error', 'Vous devez être connecté pour rejoindre un événement.');
        }

        // Vérifier si l'utilisateur est déjà inscrit
        if ($event->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Vous êtes déjà inscrit à cet événement.');
        }

        // Vérifier s'il reste des places
        $placesRestantes = $event->max_participants - $event->users()->count(); //On prend le max et on soustrait au nb d'inscrit trouvé dans la table
        if ($placesRestantes <= 0) {
            return back()->with('error', 'Plus de places disponibles pour cet événement.');
        }

        // Inscrire l'utilisateur
        $event->users()->attach($user->id);

        return back()->with('success', 'Vous avez rejoint l’événement avec succès.');
    }

    public function leaveEvent(Event $event)
    {
        $user = auth()->user();

        if (!$event->users->contains($user->id)) {
            return back()->with('error', 'Vous n\'êtes pas inscrit à cet événement.');
        }

        $event->users()->detach($user->id);

        return back()->with('success', 'Vous avez quitté l\'événement.');
    }


    public function myEvents()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer uniquement les événements créés par cet utilisateur
        $events = Event::where('user_id', $user->id)->get();

        // Retourner la vue avec les événements
        return view('myEvent', compact('events'));
    }

    public function viewMore(Event $event)
    {
        // Récupérer les utilisateurs inscrits à cet événement via la relation définie dans le modèle
        $users = $event->users;

        // Retourner la vue avec les utilisateurs inscrits
        return view('viewMore', compact('event', 'users'));
    }

    public function removeUser(Event $event, User $user)
    {

        $event->users()->detach($user->id);

        return back()->with('success', "L'utilisateur a été supprimé de l'événement.");
    }

    public function addEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_type' => 'required|string',
            'sport_id' => 'required|exists:sports,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'max_participants' => 'required|integer|min:1',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->type = $request->event_type;
        $event->sport_id = $request->sport_id;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->max_participants = $request->max_participants;
        $event->user_id = auth()->id(); // le créateur de l’événement
        $event->save();

        return redirect()->back()->with('success', 'Event created successfully!');
    }

    public function deleteEvent(Event $event) {
        $event->delete();
        return back()->with('success', 'Event deleted successfully!');
    }






}
