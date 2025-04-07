<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="wrapper">
        <main class="content">
            <h2 style="margin-bottom: 30px;">Admin Dashboard - Posts Management</h2>

            <!-- Liste de tous les posts -->
            @foreach($posts as $post)
                <div class="post">
                    <div class="post-header">
                        <a href="{{ route('account.show', $post->user->id) }}">
                            <img src="{{ $post->user->profile_photo_path
                                ? asset('storage/' . $post->user->profile_photo_path)
                                : asset('pictures/pop.png') }}"
                                 alt="Photo de profil"
                                 class="nav-profile-pic">
                        </a>
                        <div class="post-info">
                            <strong>{{ $post->user->name }}</strong>
                            <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    @if($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post" class="post-image">
                    @endif

                    <p>{{ $post->content }}</p>

                    <!-- Bouton de suppression visible pour l'admin -->
                    <form action="{{ route('deletePost', $post->id) }}" method="POST" style="margin-top: 15px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="locker-btn" style="background-color: crimson;">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </main>
    </div>
</x-app-layout>
