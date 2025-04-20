<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}">

    <h2>Abonnement(s) de {{ $user->name }} :</h2>
    <div class="user-list">
        @foreach($following as $index => $followed)
            <button class="user-row {{ $index % 2 == 0 ? 'even' : 'odd' }}">
                <img src="{{ $followed->profile_photo_url ?? asset('images/default-profile.png') }}"
                     alt="PP de {{ $followed->name }}" class="profile-pic">
                <span class="user-info">{{ $followed->name }} - {{ $followed->email }}</span>
            </button>
        @endforeach
    </div>
</x-app-layout>
