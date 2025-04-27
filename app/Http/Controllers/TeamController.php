<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Club;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        // Liste fixe de sports et leurs ligues associées
        $sports = [
            'Soccer' => [
                'English Premier League',
                'French Ligue 1',
                'Spanish La Liga',
                'Italian Serie A',
                'German Bundesliga',
                'Portuguese Primeira Liga',
                'Brazilian Serie A',
            ],
            'Basketball' => [
                'NBA',
            ],
            'Rugby' => [
                'Six Nations Championship',
                'Super Rugby',
            ],
        ];

        // Récupération du sport sélectionné
        $selectedSport = $request->query('sport', 'Soccer');

        // Récupération des ligues pour le sport sélectionné
        $leagues = $sports[$selectedSport] ?? [];

        // Récupération de la ligue sélectionnée
        $selectedLeague = $request->query('league', $leagues[0] ?? null);

        // Récupération des équipes pour la ligue sélectionnée
        $teams = [];
        if ($selectedLeague) {
            $response = Http::get('https://www.thesportsdb.com/api/v1/json/3/search_all_teams.php', [
                'l' => $selectedLeague
            ]);

            $teams = $response->json()['teams'] ?? [];
        }

        // Envoi des données à la vue
        return view('teams.index', [
            'sports' => array_keys($sports),
            'selectedSport' => $selectedSport,
            'leagues' => $leagues,
            'selectedLeague' => $selectedLeague,
            'teams' => $teams,
        ]);
    }

    public function show(Request $request)
    {
        $teamEncoded = $request->input('team');
        $team = json_decode(base64_decode($teamEncoded), true);

        if (!$team) {
            return abort(400, 'Équipe invalide ou non envoyée');
        }

        $club = Club::with('users')->where('api_id', $team['idTeam'])->first();

        return view('teams.show', compact('team', 'club'));
    }
    public function showChallenges()
    {
        return view('teams.all_challenges');
    }
}
