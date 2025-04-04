<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/showEvent.css') }}">
    <div class="nav-links">
        <a href="{{ route('showEvent') }}" class="nav-link">Event</a>
        <a href="{{ route('myEvents') }}" class="nav-link">MyEvent</a>
    </div>

        <div class="event-section">
            @if($events->isEmpty())
                <p>Aucun événement créé...</p>
            @else
                @foreach($events as $event)
                    <div class="event-card" data-type="{{$event->type}}">
                        <h2>{{$event->title}}</h2>
                        <p><strong>Sport:</strong> {{$event->sport->name}}</p>
                        <p><strong>Date:</strong> {{$event->date}}</p>
                        <p><strong>Time:</strong> {{$event->time}}</p>
                        <p><strong>Location:</strong> {{$event->location}}</p>
                        <p><strong>Description:</strong> {{$event->description}}</p>
                        <p><strong>Number of Registered:</strong> {{$event->place_prises}} / {{$event->max_participants}}</p>
                        <form action="{{ route('viewMore', $event->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="join-btn"> View More</button>
                        </form>
                    </div>

                @endforeach
            @endif
        </div>

    <x-trending/>
</x-app-layout>
