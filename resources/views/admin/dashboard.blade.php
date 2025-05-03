<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <div class="wrapper">
        <main class="content">
            <h2 style="margin-bottom: 30px;">Admin Dashboard</h2>

            <!-- Filters -->
            <div class="dashboard-filters">
                <button class="filter-btn active" data-target="posts-section">Posts</button>
                <button class="filter-btn" data-target="users-section">Users</button>
                <button class="filter-btn" data-target="events-section">Events</button>
            </div>

            <!-- SECTION: Posts -->
            <div id="posts-section" class="dashboard-section active">
                @foreach($posts as $post)
                    <div class="card admin-item">
                        <div class="card-header">
                            <img src="{{ $post->user->profile_photo_url }}" alt="Photo de profil">
                            <div>
                                <strong>{{ $post->user->name }}</strong>
                                <div class="timestamp">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="card-content">
                            <p>{{ $post->content }}</p>
                        </div>
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" class="card-image" alt="Image du post">
                        @endif
                        <form action="{{ route('deletePostAdmin', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- SECTION: Users -->
            <div id="users-section" class="dashboard-section">
                @foreach($users as $user)
                    <div class="card admin-item">
                        <div class="card-header">
                            <img src="{{ $user->profile_photo_url }}" alt="Photo de profil">
                            <div>
                                <strong>{{ $user->name }}</strong>
                                <div class="timestamp">{{ $user->email }}</div>
                            </div>
                        </div>
                        <form action="{{ route('deleteUserAdmin', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- SECTION: Events -->
            <div id="events-section" class="dashboard-section">
                @foreach($events as $event)
                    <div class="card admin-item">
                        <div class="card-header">
                            <div>
                                <strong>{{ $event->title }}</strong>
                                <div class="timestamp">{{ $event->date }}</div>

                            </div>
                        </div>
                        <form action="{{ route('deleteEventAdmin', ['event' => $event->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
</x-app-layout>
<!-- DO -->
