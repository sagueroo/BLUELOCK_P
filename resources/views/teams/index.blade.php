@php use Illuminate\Support\Facades\Auth; @endphp

<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/clubs/index.css') }}">

    <div class="clubs-container">
        @if (session('error'))
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 1.2rem; border-radius: 8px; text-align: center; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">
                    {{ session('error') }}
                </div>

                @if (Auth::user() && Auth::user()->club)
                    <div style="font-size: 0.95rem; color: #991b1b;">
                        Current club: <strong>{{ Auth::user()->club->name }}</strong>
                    </div>
                @endif
            </div>
        @endif

        <!-- Sport selector -->
        <div class="league-selector">
            <form method="GET" action="{{ route('teams.index') }}">
                <select name="sport" onchange="this.form.submit()">
                    @foreach ($sports as $sportName)
                        <option value="{{ $sportName }}" {{ $sportName == $selectedSport ? 'selected' : '' }}>
                            {{ ucfirst($sportName) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- League selector -->
        <div class="league-selector">
            <form method="GET" action="{{ route('teams.index') }}">
                <input type="hidden" name="sport" value="{{ $selectedSport }}">
                <select name="league" onchange="this.form.submit()">
                    @foreach ($leagues as $league)
                        <option value="{{ $league }}" {{ $selectedLeague == $league ? 'selected' : '' }}>
                            {{ $league }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Teams grid -->
        <div class="teams-grid">
            @foreach ($teams as $team)
                <div class="team-card">
                    <img src="{{ $team['strBadge'] ?? asset('pictures/pop.png') }}" alt="{{ $team['strTeam'] }}" class="team-logo">

                    <div class="team-info">
                        <p class="team-name">{{ $team['strTeam'] }}</p>

                        <div class="button-group">
                            <!-- VIEW -->
                            <form method="POST" action="{{ route('teams.show') }}">
                                @csrf
                                <input type="hidden" name="team" value="{{ base64_encode(json_encode($team)) }}">
                                <button type="submit" class="voir-button">VIEW</button>
                            </form>

                            <!-- JOIN / JOINED -->
                            @php
                                $isJoined = Auth::check() && Auth::user()->club && Auth::user()->club->api_id == $team['idTeam'];
                            @endphp

                            @if ($isJoined)
                                <form method="POST" action="{{ route('clubs.toggle', $team['idTeam']) }}">
                                    @csrf
                                    <button type="submit" class="joined-button leave-button">ALREADY JOINED</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('clubs.join', $team['idTeam']) }}">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $team['strTeam'] }}">
                                    <input type="hidden" name="badge" value="{{ $team['strBadge'] ?? '' }}">
                                    <button type="submit" class="join-button">JOIN</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-shop />
</x-app-layout>
