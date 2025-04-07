<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/blueEvent.css') }}">
    <div class="nav-links">
        <a href="{{ route('blueevent') }}" class="nav-link">Event</a>
        <a href="{{ route('myEvents') }}" class="nav-link">MyEvent</a>
    </div>
        <div class="event-section">
            <div class="buttons">
                <button class="btn filter-btn" data-type="Tournament">Tournament</button>
                <button class="btn filter-btn" data-type="Training">Training</button>
                <button class="btn filter-btn" data-type="Conference">Conference</button>
            </div>
            @foreach($events as $event)
                <div class="event-card" data-type="{{$event->type}}">
                    <h2>{{$event->title}}</h2>
                    <p><strong>Sport:</strong> {{$event->sport->name}}</p>
                    <p><strong>Date:</strong> {{$event->date}}</p>
                    <p><strong>Time:</strong> {{$event->time}}</p>
                    <p><strong>Location:</strong> {{$event->location}}</p>
                    <p><strong>Description:</strong> {{$event->description}}</p>
                    <p><strong>Number of Registered:</strong> {{$event->place_prises}} / {{$event->max_participants}}</p>
                    @php
                        $isRegistered = $event->users->contains(auth()->id());
                    @endphp
                    <form action="{{ $isRegistered ? route('leaveEvent', $event->id) : route('joinEvent', $event->id) }}" method="POST">
                        @csrf
                        @if($isRegistered)
                            @method('DELETE')
                        @endif
                        <button type="submit" class="join-btn {{ $isRegistered ? 'joined' : '' }}">
                            {{ $isRegistered ? 'Leave' : 'Join' }}
                        </button>
                    </form>
                    @if($event->user)
                    <div class="event-creator">
                        <p>Created by: <strong>{{ $event->user->name }}</strong></p>
                    </div>
                    @else
                        <div class="event-creator">
                            <p>Creator info not available</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    <x-trending/>
</x-app-layout>
<script src="{{ asset('js/blueEvent.js') }}"></script>

