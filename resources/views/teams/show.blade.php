@php use Illuminate\Support\Str; @endphp

<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/clubs/show.css') }}">

    <div class="team-container">

        <!-- Title -->
        <div class="team-header">
            <h1 class="team-name">{{ $team['strTeam'] }}</h1>
            <p class="team-info">
                {{ $team['strCountry'] ?? 'N/A' }} |
                {{ $team['strStadium'] ?? 'N/A' }} |
                {{ $team['intFormedYear'] ?? 'N/A' }}
            </p>
        </div>

        <div class="jersey-row">
            <!-- Maillot 1 : locked -->
            <div class="jersey-card locked">
                <img src="{{ asset('pictures/placeholder-shirt.png') }}" alt="Maillot à venir" class="jersey-img">
                <p class="jersey-label">Soon...</p>
            </div>

            <!-- Maillot 2 : principal -->
            <div class="jersey-card">
                <img src="{{ $team['strEquipment'] }}" alt="Maillot principal" class="jersey-img">
                <p class="jersey-label">Home</p>
            </div>

            <!-- Maillot 1 : locked -->
            <div class="jersey-card locked">
                <img src="{{ asset('pictures/placeholder-shirt.png') }}" alt="Maillot à venir" class="jersey-img">
                <p class="jersey-label">Soon...</p>
            </div>
        </div>



        <!-- Fanart -->
        @if (!empty($team['strFanart3']))
            <div class="fanart-section">
                <img src="{{ $team['strFanart2'] }}" class="fanart-img" alt="Fanart">
            </div>
        @endif

        <!-- Description -->
        @if (!empty($team['strDescriptionEN']))
            @php
                $desc = $team['strDescriptionEN'];
                $shortDesc = Str::limit($desc, 300);
                $isShortened = strlen($desc) > 300;
            @endphp

            <div class="desc-section">
                <div x-data="{ expanded: false }">
                    <div x-show="!expanded" x-cloak>{!! nl2br(e($shortDesc)) !!}</div>
                    <div x-show="expanded" x-cloak x-transition>{!! nl2br(e($desc)) !!}</div>
                    @if ($isShortened)
                        <button class="toggle-desc" @click="expanded = !expanded">
                            <span x-text="expanded ? 'Lire moins' : 'Lire plus'"></span>
                        </button>
                    @endif
                </div>
            </div>
        @endif

        <!-- Members -->
        @if ($club && $club->users && $club->users->count() > 0)
            <h2 class="members-title">Membres du club</h2>
            <ul class="members-list">
                @foreach ($club->users->take(3) as $user)
                    <li class="member-card">
                        <div class="member-pic"
                             style="background-image: url('{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('pictures/pop.png') }}');">
                        </div>
                        <a href="{{ route('account.show', ['id' => $user->id]) }}">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @if ($club->users->count() > 3)
                <a href="{{ route('clubs.members', $club->id) }}" class="see-more">Show all the members</a>
            @endif
        @endif

    </div>
    <x-shop />
</x-app-layout>
