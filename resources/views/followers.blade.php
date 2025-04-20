<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}"> {{-- Ton CSS déjà utilisé --}}

    <h2>Abonné(s) de {{ $user->name }} :</h2>
    <div class="user-list">
        @foreach($followers as $index => $follower)
            <button class="user-row {{ $index % 2 == 0 ? 'even' : 'odd' }}">
                <img src="{{ $follower->profile_photo_url ?? asset('images/default-profile.png') }}"
                     alt="PP de {{ $follower->name }}" class="profile-pic">
                <span class="user-info">{{ $follower->name }} - {{ $follower->email }}</span>
            </button>
        @endforeach
    </div>
</x-app-layout>
