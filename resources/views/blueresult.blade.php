<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/blueResult.css') }}">
    <form method="GET" action="{{ route('blueresult') }}" class="league-form">
        <label for="league">Choose a league :</label>
        <select name="league" id="league" onchange="this.form.submit()">
            {{-- Set the selected option based on current league --}}
            <option value="PL" {{ $selectedLeague == 'PL' ? 'selected' : '' }}>Premier League</option>
            <option value="FL1" {{ $selectedLeague == 'FL1' ? 'selected' : '' }}>Ligue 1</option>
            <option value="PD" {{ $selectedLeague == 'PD' ? 'selected' : '' }}>La Liga</option>
            <option value="SA" {{ $selectedLeague == 'SA' ? 'selected' : '' }}>Serie A</option>
            <option value="BL1" {{ $selectedLeague == 'BL1' ? 'selected' : '' }}>Bundesliga</option>
        </select>
    </form>

    {{-- Title displaying current selected league --}}
    <h1 class="title">Match results - {{ strtoupper($selectedLeague) }}</h1>

    <div class="match-container">
        @forelse ($recentMatches as $match)
            <div class="match-card">
                {{-- Home team --}}
                <div class="team">
                    <img src="{{ $match['homeTeam']['crest'] ?? '' }}" alt="Logo" class="team-logo">
                    <p class="team-name">{{ $match['homeTeam']['name'] ?? 'Inconnu' }}</p>
                </div>

                {{-- Score and match date --}}
                <div class="match-info">
                    <div class="score">
                        {{ $match['score']['fullTime']['home'] ?? '-' }} - {{ $match['score']['fullTime']['away'] ?? '-' }}
                    </div>
                    <div class="date">
                        {{ \Carbon\Carbon::parse($match['utcDate'])->format('d/m/Y H:i') }}
                    </div>
                </div>

                {{-- Away team --}}
                <div class="team">
                    <img src="{{ $match['awayTeam']['crest'] ?? '' }}" alt="Logo" class="team-logo">
                    <p class="team-name">{{ $match['awayTeam']['name'] ?? 'Inconnu' }}</p>
                </div>
            </div>
        @empty
            {{-- if no matches are available --}}
            <p class="no-matches">No recent matches available.</p>
        @endforelse
    </div>
    <x-trending />
</x-app-layout>
{{--DO--}}
