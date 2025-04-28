<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/clubs/members.css') }}">

    <div class="members-container">
        <h1 class="club-title">Membres de {{ $club->name }}</h1>
        <p class="member-count">{{ $club->users->count() }} membres</p>

        <ul class="member-list">
            @foreach ($club->users as $user)
                <li class="member-item">
                    <div class="member-avatar" style="background-image: url('{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('pictures/pop.png') }}');"></div>
                    <a href="{{ route('account.show', ['id' => $user->id]) }}" class="member-name">
                        {{ $user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
