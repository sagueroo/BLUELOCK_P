<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/account/account.css') }}">

    <div class="header">
        <div class="profile-pic" style="background-image: url('{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}');"></div>
        <div class="user-info">
            <div class="user-header">
                <h2>{{ Auth::user()->name }}</h2>
                <a href="{{ route('moreSetting') }}">
                    <button class="btn-follow">Edit Profile</button>
                </a>
            </div>
            <div class="stats">
                <div>
                    <strong>{{ $postsCount }}</strong>
                    <p>Posts</p>
                </div>
                <div>
                    <a href="{{ route('showFollowers', ['id' => Auth::user()->id])}}">
                        <strong>{{ $followersCount }}</strong>
                        <p>Followers</p>
                    </a>
                </div>
                <div>
                    <a href="{{ route('showFollowing',['id' => Auth::user()->id])}}">
                        <strong>{{ $followingCount }}</strong>
                        <p>Following</p>
                    </a>
                </div>
            </div>

            <p>{{ Auth::user()->bio }} </p>
        </div>
    </div>

    <!-- Navigation between posts and club info -->
    <div class="navigation">
        <button id="btn-posts" class="tab-button active">Posts</button>
        <button id="btn-club" class="tab-button">Club</button>
    </div>

    <div class="content">
        <!-- Posts section -->
        <div id="posts-section" class="tab-section">
            <div class="gallery">
                @foreach($posts as $post)
                    <div class="post" onclick="confirmDeletePost({{ $post->id }})">
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" class="post-image">
                        @else
                            <p>{{ $post->content }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Club section -->
        <div id="club-section" class="tab-section" style="display: none;">
            @if(Auth::user()->club)
                <div class="club-info">
                    <img src="{{ Auth::user()->club->badge ?? asset('pictures/pop.png') }}" alt="Club badge" style="width: 100px; height: 100px;">
                    <p style="margin-top: 10px;">{{ Auth::user()->club->name }}</p>
                </div>
            @else
                <p style="text-align: center; margin-top: 1rem;">No club at the moment</p>
            @endif
        </div>
    </div>

    <!-- Delete post confirmation modal -->
    <div id="confirmPostModal" class="modal">
        <div class="modal-content">
            <p id="modalPostText">Do you really want to delete this post?</p>
            <form id="deletePostForm" method="POST">
                @csrf
                @method('DELETE')
                <button class="confirm" type="submit">Delete</button>
                <button class="cancel" type="button" onclick="closePostModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/account/account.js') }}"></script>
</x-app-layout>
{{--DO--}}
