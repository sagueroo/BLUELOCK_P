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
                    <!-- Bouton "Suivi(e)" avec option de désabonnement -->
                    <form action="{{ route('account.unfollow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-follow active">Suivi(e)</button>
                    </form>
                @else
                    <!-- Bouton "Suivre" -->
                    <form action="{{ route('account.follow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-follow">Suivre</button>
                    </form>
                @endif
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
            <p>{{ $user->bio }}</p>
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
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post" class="post-image">
                @else
                    <p>{{ $post->content }}</p>
                @endif
            </div>
        @endforeach
    </div>

</x-app-layout>
