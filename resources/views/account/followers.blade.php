<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/viewMore.css') }}">


    <h2>Followers of {{ $user->name }}</h2>

    <div class="user-list">
        {{-- Looping through each follower --}}
        @forelse($followers as $index => $follower)
            <a href="{{ route('account.show', ['id' => $follower->id]) }}">
                <div class="user-row {{ $index % 2 === 0 ? 'even' : 'odd' }}">
                    <img src="{{ $follower->profile_photo_path ? asset('storage/' . $follower->profile_photo_path) : asset('images/default-profile.png') }}" alt="{{ $follower->name }}" class="profile-pic">
                    <span class="user-info">{{ $follower->name }}</span>
                </div>
            </a>
        @empty
            <p>No followers yet.</p>
        @endforelse
    </div>
    <x-trending />
</x-app-layout>
{{--DO--}}
