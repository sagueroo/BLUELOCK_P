<x-app-layout>
    <form method="GET" action="{{ route('blueresult') }}" class="league-form">
        <label for="league">Choisir une ligue :</label>
        <select name="league" id="league" onchange="this.form.submit()">
            <option value="PL" {{ $selectedLeague == 'PL' ? 'selected' : '' }}>Premier League</option>
            <option value="FL1" {{ $selectedLeague == 'FL1' ? 'selected' : '' }}>Ligue 1</option>
            <option value="PD" {{ $selectedLeague == 'PD' ? 'selected' : '' }}>La Liga</option>
            <option value="SA" {{ $selectedLeague == 'SA' ? 'selected' : '' }}>Serie A</option>
            <option value="BL1" {{ $selectedLeague == 'BL1' ? 'selected' : '' }}>Bundesliga</option>
        </select>
    </form>

    <h1 class="title">Résultats des matchs - {{ strtoupper($selectedLeague) }}</h1>

        <div class="match-container">
            @forelse ($recentMatches as $match)
                <div class="match-card">
                    <!-- Équipe Domicile -->
                    <div class="team">
                        <img src="{{ $match['homeTeam']['crest'] ?? '' }}" alt="Logo" class="team-logo">
                        <p class="team-name">{{ $match['homeTeam']['name'] ?? 'Inconnu' }}</p>
                    </div>

                    <!-- Score -->
                    <div class="match-info">
                        <div class="score">
                            {{ $match['score']['fullTime']['home'] ?? '-' }} - {{ $match['score']['fullTime']['away'] ?? '-' }}
                        </div>
                        <div class="date">
                            {{ \Carbon\Carbon::parse($match['utcDate'])->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <!-- Équipe Extérieure -->
                    <div class="team">
                        <img src="{{ $match['awayTeam']['crest'] ?? '' }}" alt="Logo" class="team-logo">
                        <p class="team-name">{{ $match['awayTeam']['name'] ?? 'Inconnu' }}</p>
                    </div>


                </div>
            @empty
                <p class="no-matches">Aucun match récent disponible.</p>
            @endforelse
        </div>
    <x-trending/>
</x-app-layout>
<style>

    .league-form {
        text-align: center;
        margin-bottom: 20px;
        padding-top: 20px;
    }

    .league-form label {
        font-size: 16px;
        font-weight: bold;
        margin-right: 10px;
    }

    .league-form select {
        padding: 5px 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
    }


    .title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .match-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .match-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f4f4f4;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        flex-wrap: wrap; /* Permet de mieux gérer l'affichage si nécessaire */
        position: relative; /* Pour mieux positionner la date */
    }

    .match-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 30%;
    }

    .team {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 30%;
    }

    .team-logo {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .team-name {
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    .score {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }

    .date {
        font-size: 14px;
        color: gray;
        text-align: center;
        margin-top: 5px;
    }

    .no-matches {
        text-align: center;
        color: gray;
    }

</style>
