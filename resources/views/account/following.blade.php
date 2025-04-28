<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}">

    <h2>Subscription(s) of {{ $user->name }} :</h2>

    <div class="user-list">
        {{-- Looping through each user that the current user follows --}}
        @foreach($following as $index => $followed)
            <a href="{{ route('account.show', ['id' => $followed->id]) }}">
                <div class="user-row {{ $index % 2 == 0 ? 'even' : 'odd' }}">
                    <img src="{{ $followed->profile_photo_path ? asset('storage/' . $followed->profile_photo_path) : asset('images/default-profile.png') }}" alt="{{ $followed->name }}" class="profile-pic">
                    <span class="user-info">{{ $followed->name }}</span>
                </div>
            </a>
        @endforeach
    </div>
    <x-trending />
</x-app-layout>
{{--DO--}}
