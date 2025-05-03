{{-- This page reuses various layouts from other pages (users, posts, events, sports),
     which explains why the code is relatively long and repetitive --}}
<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blueSport.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blueEvent.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search/results.css') }}">

    <div class="result">
        <!-- User search results -->
        <div class="search-section">
            <h3 class="section-title">Results for Users</h3>
            <div class="user-list">
                @forelse($users as $index => $user)
                    <a href="{{ route('account.show', ['id' => $user->id]) }}">
                        <div class="user-row {{ $index % 2 === 0 ? 'even' : 'odd' }}">
                            <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-profile.png') }}" alt="{{ $user->name }}" class="profile-pic">
                            <span class="user-info">{{ $user->name }}</span>
                        </div>
                    </a>
                @empty
                    <p class="no-results">No users found.</p>
                @endforelse
            </div>
        </div>
        <hr class="separator">

        <!-- Sports search results -->
        <div class="search-section">
            <h3 class="section-title">Results for Sports</h3>
            <div class="results">
                @forelse($sports as $sport)
                    <div class="sport">
                        <p>{{ $sport->name }}</p>
                        @if($sport->isRegistered)
                            <form action="{{ route('deleteSport') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                                <button type="submit" class="locker-btn2">ALREADY REGISTERED</button>
                            </form>
                        @else
                            <form action="{{ route('addSport') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sport_id" value="{{ $sport->id }}">
                                <x-locker-btn/>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="no-results">No sports found.</p>
                @endforelse
            </div>
        </div>
        <hr class="separator">

        <!-- Posts search results -->
        <div class="search-section">
            <h3 class="section-title">Results for Posts</h3>
            <div class="results">
                @forelse($posts as $post)
                    <div class="post">
                        <div class="post-header">
                            <a href="{{ route('account.show', ['id' => $post->user->id]) }}">
                                <img src="{{ $post->user->profile_photo_path ? (\Illuminate\Support\Str::startsWith($post->user->profile_photo_path, 'http') ? $post->user->profile_photo_path : asset('storage/' . $post->user->profile_photo_path)) : asset('pictures/pop.png') }}"
                                     alt="Profile picture"
                                     class="nav-profile-pic">
                            </a>
                            <div class="post-info">
                                <!-- Link to the user profile -->
                                <a href="{{ route('account.show', ['id' => $post->user->id]) }}">
                                    <strong>{{ $post->user->name }}</strong>
                                </a>
                                <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <!-- Display image if it exists -->
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" class="post-image">
                        @endif
                        <p>{{ $post->content }}</p>
                    </div>
                @empty
                    <p class="no-results">No posts found.</p>
                @endforelse
            </div>
        </div>
        <hr class="separator">

        <!-- Events search results -->
        <div class="search-section">
            <h3 class="section-title">Results for Events</h3>
            <div class="results">
                @forelse($events as $event)
                    <div class="event-card" data-type="{{ $event->type }}">
                        <h2>{{ $event->title }}</h2>
                        <p><strong>Sport:</strong> {{ $event->sport->name }}</p>
                        <p><strong>Date:</strong> {{ $event->date }}</p>
                        <p><strong>Time:</strong> {{ $event->time }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Description:</strong> {{ $event->description }}</p>
                        <p><strong>Registered:</strong> {{ $event->place_prises }} / {{ $event->max_participants }}</p>

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
                @empty
                    <p class="no-results">No events found.</p>
                @endforelse
            </div>
        </div>
    </div>
    <x-trending/>
</x-app-layout>
<!-- DO -->
