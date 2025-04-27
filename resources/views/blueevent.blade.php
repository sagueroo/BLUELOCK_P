<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/blueEvent.css') }}">
    <div class="nav-links">
        <a href="{{ route('blueevent') }}" class="nav-link">Event</a>
        <a href="{{ route('myEvents') }}" class="nav-link">MyEvent</a>
    </div>
        <div class="event-section">
            <div class="buttons">
                <button class="btn filter-btn" data-type="Tournament">Tournaments</button>
                <button class="btn filter-btn" data-type="Training">Training</button>
                <button class="btn filter-btn" data-type="Conference">Conference</button>
                <button class="btn add-event-btn" id="addEventBtn">+</button>
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

    <!-- Popup pour la création d'un événement -->
    <div id="createEventPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <h2>Create Event</h2>
            <form action="{{ route('addEvent') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Event Title</label>
                    <input type="text" name="title" id="title" placeholder="Event Title" required>
                </div>
                <div class="form-group">
                    <label for="event_type">Event Type</label>
                    <select name="event_type" id="event_type" required>
                        <option value="Tournament">Tournament</option>
                        <option value="Training">Training</option>
                        <option value="Conference">Conference</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sport">Sport:</label>
                    <select name="sport_id" id="sport" required>
                        @foreach($sportsSubscribed as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Event Date</label>
                    <input type="date" name="date" id="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Event Time</label>
                    <input type="time" name="time" id="time" required>
                </div>
                <div class="form-group">
                    <label for="location">Event Location</label>
                    <input type="text" name="location" id="location" placeholder="Location" required>
                </div>
                <div class="form-group">
                    <label for="description">Event Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Event Description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="max_participants">Max Participants</label>
                    <input type="number" name="max_participants" id="max_participants" min="1" placeholder="Maximum participants" required>
                </div>
                <button type="submit" class="btn">Create Event</button>
                <button type="button" class="btn cancel-btn" id="cancelEventBtn">Cancel</button>
            </form>
        </div>
    </div>



</x-app-layout>
<script src="{{ asset('js/blueEvent.js') }}"></script>
<script>
    document.getElementById('addEventBtn').addEventListener('click', function() {
        document.getElementById('createEventPopup').style.display = 'flex';
    });

    document.getElementById('cancelEventBtn').addEventListener('click', function() {
        document.getElementById('createEventPopup').style.display = 'none';
    });
</script>
