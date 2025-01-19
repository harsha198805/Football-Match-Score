<?php

namespace App\Http\Controllers;

use App\Events\FootballScoreUpdated;
use Illuminate\Http\Request;
use App\Models\Score;

class FootballScoreController extends Controller
{
    private $score = [
        'teamA' => 0,
        'teamB' => 0,
        'status' => 'In Progress',
    ];

    public function index()
    {
        $score_new = Score::latest()->first();
        $score = [
            'teamA' => $score_new->team_a_score??0,
            'teamB' => $score_new->team_b_score??0,
            'status' => $score_new->status??'Not Started',
        ];

        // Broadcast the updated score to all clients
        event(new FootballScoreUpdated($score));
        
        return view('football', compact('score'));
    }
    public function updateScore()
    {
        
        $score_new = Score::latest()->first();
        $score = [
            'teamA' => $score_new->team_a_score??0,
            'teamB' => $score_new->team_b_score??0,
            'status' => $score_new->status??'Not Started',
        ];
    
        event(new FootballScoreUpdated($this->score));

        return response()->json($this->score);
    }
}
