<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/account/account.css') }}">
    <div class="header">
        <div class="profile-pic" style="background-image: url('{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}');"></div>
        <div class="user-info">
            <div class="user-header">
                <h2>{{ Auth::user()->name }}</h2>
                <a href="{{ route('moreSetting') }}">
                    <button class="btn-follow">Modify profile</button>
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

    <!-- Navigation -->
    <div class="navigation">
        <a href="#">Posts</a>
        <a href="#">Team</a>
    </div>

    <!-- Publications -->
    <div class="gallery">
        @foreach($posts as $post)
            <div class="post" onclick="confirmDeletePost({{ $post->id }})">
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post" class="post-image">
                @else
                    <p>{{ $post->content }}</p>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Modal de suppression de post -->
    <div id="confirmPostModal" class="modal">
        <div class="modal-content">
            <p id="modalPostText">Do you really want to delete this post? ?</p>
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


