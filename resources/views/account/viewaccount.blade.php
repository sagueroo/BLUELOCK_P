<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/account/account.css') }}">

    <div class="header">
        <div class="profile-pic" style="background-image: url('{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('pictures/pop.png') }}');"></div>

        <div class="user-info">
            <div class="user-header">
                <h2>{{ $user->name }}</h2>

                @php
                    $isFollowing = \App\Models\Follower::where('follower_id', auth()->id())
                                                       ->where('following_id', $user->id)
                                                       ->exists();
                @endphp

                @if($isFollowing)
                    <form action="{{ route('account.unfollow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-follow active">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('account.follow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-follow">Follow</button>
                    </form>
                @endif
            </div>

            <div class="stats">
                <div>
                    <strong>{{ $postsCount }}</strong>
                    <p>Posts</p>
                </div>
                <div>
                    <strong>{{ $followersCount }}</strong>
                    <p>Followers</p>
                </div>
                <div>
                    <strong>{{ $followingCount }}</strong>
                    <p>Following</p>
                </div>
            </div>

            <p>{{ $user->bio }}</p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="navigation">
        <button id="btn-posts" class="tab-button active">Posts</button>
        <button id="btn-club" class="tab-button">Club</button>
    </div>

    <div class="content">
        <!-- Posts -->
        <div id="posts-section" class="tab-section">
            <div class="gallery">
                @foreach($posts as $post)
                    <div class="post">
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" class="post-image">
                        @else
                            <p>{{ $post->content }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Club -->
        <div id="club-section" class="tab-section" style="display: none;">
            @if($user->club)
                <div class="club-info">
                    <img src="{{ $user->club->badge ?? asset('pictures/pop.png') }}" alt="Club badge" style="width: 100px; height: 100px;">
                    <p style="margin-top: 10px;">{{ $user->club->name }}</p>
                </div>
            @else
                <p style="text-align: center; margin-top: 1rem;">No club at the moment</p>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/account/account.js') }}"></script>
</x-app-layout>
