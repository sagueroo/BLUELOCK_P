<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Event;

class EventController
{
    public function showEvent()
    {
        // Récupère l'utilisateur actuellement authentifié
        $user = auth()->user();

        // Récupère les sports auxquels l'utilisateur est inscrit
        $sportsUserIsSubscribedTo = $user->sports->pluck('id');  // Pluck pour récupérer uniquement les IDs des sports

        // Récupère les événements associés à ces sports et charge les relations sport et user
        $events = Event::with('sport', 'user')  // 'sport' pour récupérer le sport lié à l'événement, 'user' pour récupérer l'utilisateur qui a créé l'événement
        ->whereIn('sport_id', $sportsUserIsSubscribedTo)  // Filtre par les sports auxquels l'utilisateur est inscrit
        ->get();

        // Calcul du nombre de places restantes pour chaque événement
        foreach ($events as $event) {
            $event->place_prises = $event->users->count();
        }

        return view('blueevent', compact('events'));
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






}
