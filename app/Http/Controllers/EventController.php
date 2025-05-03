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
        $user = auth()->user();

        // Retrieves sports in which the user is registered
        $sportsSubscribed = $user->sports;

        // Retrieves events associated with these sports and handles sport and user relations
        $events = Event::with('sport', 'user')
        ->whereIn('sport_id', $sportsSubscribed->pluck('id'))
        ->get();

        // Calculation of the number of places remaining for each event
        foreach ($events as $event) {
            $event->place_prises = $event->users->count();
        }
        return view('blueevent', compact('events', 'sportsSubscribed'));
    }


    public function joinEvent(Event $event)
    {
        $user = auth()->user();

        if (!$user) {
            return back()->with('error', 'You need to are connected to join event!');
        }

        // Check if the user is already registered
        if ($event->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You are already a member of this event!');
        }

        // Check if there are still places available
        $restingPlaces = $event->max_participants - $event->users()->count();
        if ($restingPlaces <= 0) {
            return back()->with('error', 'More places available for this event.');
        }

        // Register the user
        $event->users()->attach($user->id);

        return back()->with('success', 'You have join the event successfully!');
    }

    public function leaveEvent(Event $event)
    {
        $user = auth()->user();

        if (!$event->users->contains($user->id)) {
            return back()->with('error', 'Vous n êtes pas inscrit à cet événement.');
        }

        $event->users()->detach($user->id);

        return back()->with('success', 'Vous avez quitté l événement.');
    }


    public function myEvents()
    {
        $user = Auth::user();

        // Retrieve all the event created by the user connected
        $events = Event::where('user_id', $user->id)->get();

        return view('myEvent', compact('events'));
    }

    public function viewMore(Event $event)
    {
        // Retrieve all the user registered to the event
        $users = $event->users;
        return view('viewMore', compact('event', 'users'));
    }

    public function removeUser(Event $event, User $user)
    {
        $event->users()->detach($user->id);
        return back()->with('success', "The user was delete to the event successfully!");
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
        $event->user_id = auth()->id();
        $event->save();

        return redirect()->back()->with('success', 'Event created successfully!');
    }

    public function deleteEvent(Event $event) {
        $event->delete();
        return back()->with('success', 'Event deleted successfully!');
    }






}
