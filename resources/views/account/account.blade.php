

<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <div class="header">
        <div class="profile-pic" style="background-image: url('{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('pictures/pop.png') }}');"></div>
        <div class="user-info">
            <div class="user-header">
                <h2>{{ Auth::user()->name }}</h2>
                <a href="{{ route('setting.show') }}">
                    <button class="btn-follow">Modifier le profil</button>
                </a>
            </div>
            <div class="stats">
                <div>
                    <strong>{{ $postsCount }}</strong>
                    <p>Publications</p>
                </div>
                <div>
                    <strong>{{ $followersCount }}</strong>
                    <p>Abonnés</p>
                </div>
                <div>
                    <strong>{{ $followingCount }}</strong>
                    <p>Abonnements</p>
                </div>
            </div>
            <p>{{ Auth::user()->bio }} </p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="navigation">
        <a href="#">Publications</a>
        <a href="#">Aimé</a>
    </div>

    <!-- Publications -->
    <div class="gallery">
        @foreach($posts as $post)
            <div class="post">
                <!-- Affichage de l'image si elle existe sinon on met le texte du post -->
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post" class="post-image">
                @else
                    <p>{{ $post->content }}</p>
                @endif
            </div>
        @endforeach
    </div>

</x-app-layout>


