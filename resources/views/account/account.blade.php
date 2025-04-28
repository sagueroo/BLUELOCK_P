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
        <button id="btn-posts" class="tab-button active">Publications</button>
        <button id="btn-club" class="tab-button">Club</button>
    </div>

    <div class="content">
    <!-- Publications -->
    <div id="posts-section" class="tab-section">
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
    </div>
    <div id="club-section" class="tab-section" style="display: none;">
        @if(Auth::user()->club)
            <div class="club-info">
                <img src="{{ Auth::user()->club->badge ?? asset('pictures/pop.png') }}" alt="Badge du club" style="width: 100px; height: 100px;">
                <p style="margin-top: 10px;">{{ Auth::user()->club->name }}</p>
            </div>
        @else
            <p style="text-align: center; margin-top: 1rem;">Aucun club actuellement</p>
        @endif
    </div>
    </div>

{{--    Popup delete post--}}
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
<script>

        const btnPosts = document.getElementById('btn-posts');
        const btnClub = document.getElementById('btn-club');
        const postsSection = document.getElementById('posts-section');
        const clubSection = document.getElementById('club-section');

        btnPosts.addEventListener('click', () => {
        postsSection.style.display = 'block';
        clubSection.style.display = 'none';
        btnPosts.classList.add('active');
        btnClub.classList.remove('active');
    });

        btnClub.addEventListener('click', () => {
        postsSection.style.display = 'none';
        clubSection.style.display = 'block';
        btnClub.classList.add('active');
        btnPosts.classList.remove('active');
    });
</script>
