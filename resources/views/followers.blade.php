<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}"> {{-- Ton CSS déjà utilisé --}}

    <h2>Followers de {{ $user->name }}</h2>

    <div class="user-list">
        @forelse($followers as $index => $follower)
            <div class="user-row {{ $index % 2 === 0 ? 'even' : 'odd' }}">
                <img src="{{ $follower->profile_photo_url ?? asset('images/default-profile.png') }}" alt="{{ $follower->name }}" class="profile-pic">
                <span class="user-info">{{ $follower->name }} - {{ $follower->email }}</span>
            </div>
        @empty
            <p>Aucun abonné pour l’instant.</p>
        @endforelse
    </div>

</x-app-layout>
