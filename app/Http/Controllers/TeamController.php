<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Club;

//This class was created with the help of RA students, ChatGPT and the official API doc: https://docs.football-data.org/general/v4/resources.html
class TeamController extends Controller
{
    public function index(Request $request)
    {
        // Fixed list of sports and their associated leagues
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

        // Retrieves sport selected
        $selectedSport = $request->query('sport', 'Soccer');

        // Retrieves leagues of the sport
        $leagues = $sports[$selectedSport] ?? [];

        // Retrieve league selected
        $selectedLeague = $request->query('league', $leagues[0] ?? null);

        // Retrieve team of the league selected
        $teams = [];
        if ($selectedLeague) {
            $response = Http::get('https://www.thesportsdb.com/api/v1/json/3/search_all_teams.php', [
                'l' => $selectedLeague
            ]);
            $teams = $response->json()['teams'] ?? [];
        }

        // Send data to the view
        return view('blueteam', [
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
            return abort(400, 'Team invalid or not sent');
        }
        $club = Club::with('users')->where('api_id', $team['idTeam'])->first();
        return view('teams.show', compact('team', 'club'));
    }
    public function showChallenges()
    {
        return view('teams.allchallenges');
    }
}
