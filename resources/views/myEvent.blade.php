<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/blueEvent.css') }}">
    <div class="nav-links">
        <a href="{{ route('blueevent') }}" class="nav-link">Event</a>
        <a href="{{ route('myEvents') }}" class="nav-link">My Events</a>
    </div>

    {{-- Main event section --}}
    <div class="event-section">
        @if($events->isEmpty())
            <p>No events created yet...</p>
        @else
            @foreach($events as $event)
                <div class="event-card" data-type="{{ $event->type }}">
                    <h2>{{ $event->title }}</h2>
                    <p><strong>Sport:</strong> {{ $event->sport->name }}</p>
                    <p><strong>Date:</strong> {{ $event->date }}</p>
                    <p><strong>Time:</strong> {{ $event->time }}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <p><strong>Description:</strong> {{ $event->description }}</p>
                    <p><strong>Registered:</strong> {{ $event->place_prises }} / {{ $event->max_participants }}</p>

                    {{-- To see more one event (user registered) --}}
                    <form action="{{ route('viewMore', $event->id) }}" method="GET">
                        @csrf
                        <button type="submit" class="join-btn">View More</button>
                    </form>
                    <form action="{{ route('deleteEvent', $event->id) }}" method="GET">
                        @csrf
                        <button type="submit" class="delete-btn">Delete Event</button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>
    <x-trending/>
</x-app-layout>
{{--DO--}}
