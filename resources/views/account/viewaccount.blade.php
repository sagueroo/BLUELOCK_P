<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">

    <div class="header">
        <div class="profile-pic" style="background-image: url('{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('pictures/pop.png') }}');"></div>

        <div class="user-info">
            <div class="user-header">
                <h2>{{ $user->name }}</h2>

                <!-- Bouton Suivre -->
                <form action="{{ route('follow.toggle', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-follow">
                        {{ $isFollowing ? 'Ne plus suivre' : 'Suivre' }}
                    </button>
                </form>
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
        <!-- ici il y aura les publications -->
    </div>

</x-app-layout>
