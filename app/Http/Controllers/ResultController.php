<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon; // Ajoute Carbon pour gérer les dates

//This class was created with the help of RA students, ChatGPT and the official API doc: https://docs.football-data.org/general/v4/resources.html
class ResultController
{
    private $API_KEY = "8eaacd5855b24ed7912efae86b06cb3c";

    public function index(Request $request)
    {
        $selectedLeague = $request->query('league', 'FL1'); // Premier League default

        //Retrieve recent matches (filtered over the last 7 days)
        $recentMatches = $this->getRecentMatches($selectedLeague);
        return view('blueresult', compact('recentMatches', 'selectedLeague'));
    }

    private function getRecentMatches($competitionCode)
    {
        $url = "https://api.football-data.org/v4/competitions/{$competitionCode}/matches?status=FINISHED";

        $response = Http::withHeaders([
            'X-Auth-Token' => $this->API_KEY,
        ])->get($url);

        if ($response->failed()) {
            return [];
        }

        $matches = $response->json()['matches'] ?? [];

        // Filter matches over the last 7 days
        $sevenDaysAgo = Carbon::now()->subDays(5); // 7 days ago

        $filteredMatches = array_filter($matches, function ($match) use ($sevenDaysAgo) {
            $matchDate = Carbon::parse($match['utcDate']);
            return $matchDate->greaterThanOrEqualTo($sevenDaysAgo);
        });
        return array_values($filteredMatches);
    }

    private function getMatches($competitionCode, $status)
    {
        $url = "https://api.football-data.org/v4/competitions/{$competitionCode}/matches?status={$status}";

        $response = Http::withHeaders([
            'X-Auth-Token' => $this->API_KEY,
        ])->get($url);

        if ($response->failed()) {
            return [];
        }
        return $response->json()['matches'] ?? [];
    }
}
