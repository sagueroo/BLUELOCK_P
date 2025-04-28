<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/account/account.css') }}">

    <div class="header">
        <div class="profile-pic" style="background-image: url('{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('pictures/pop.png') }}');"></div>

        <div class="user-info">
            <div class="user-header">
                <h2>{{ $user->name }}</h2>

                @php
                    // Check if the authenticated user is following the displayed user
                    $isFollowing = \App\Models\Follower::where('follower_id', auth()->id())
                                                       ->where('following_id', $user->id)
                                                       ->exists();
                @endphp

                @if($isFollowing)
                    <!-- Unfollow button -->
                    <form action="{{ route('account.unfollow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-follow active">Unfollow</button>
                    </form>
                @else
                    <!-- Follow button -->
                    <form action="{{ route('account.follow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-follow">Follow</button>
                    </form>
                @endif
            </div>

            <div class="stats">
                <!-- User stats: posts, followers, following -->
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

    <!-- Navigation links -->
    <div class="navigation">
        <a href="#">Posts</a>
        <a href="#">Teams</a>
    </div>

    <!-- User's posts gallery -->
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
</x-app-layout>
{{--DO--}}
