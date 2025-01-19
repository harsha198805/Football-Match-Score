<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Events\FootballScoreUpdated;

class ScoreController extends Controller
{

    public function index()
    {
        // Fetch the latest score
        $score = Score::latest()->first(); 

        // If no score is found, use default values
        if (!$score) {
            $score = new Score(['team_a_score' => 0, 'team_b_score' => 0, 'status' => 'not_started']);
        }

        // Pass the score data to the view
        return view('football', compact('score'));
    }
    // Fetch the latest score from the database
    public function show()
    {
        $score = Score::latest()->first();
        $score = [
            'teamA' => $score->team_a_score??0,
            'teamB' => $score->team_b_score??0,
            'status' => $score->status??'Not Started',
        ];
        return view('score-update',compact('score'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'team_a_score' => 'required|integer',
            'team_b_score' => 'required|integer',
            'status' => 'required|string|in:not_started,in_progress,completed'
        ]);

        // Fetch the latest score from the database
        $score = Score::latest()->first();

        if (!$score) {
            // Create new score record if it doesn't exist
            $score = Score::create([
                'team_a_score' => $request->team_a_score,
                'team_b_score' => $request->team_b_score,
                'status' => $request->status,
            ]);
        } else {
            // Update existing score record
            $score->update([
                'team_a_score' => $request->team_a_score + $score->team_a_score,
                'team_b_score' => $request->team_b_score + $score->team_b_score,
                'status' => $request->status,
            ]);
        }
        $score_total = Score::latest()->first();
        broadcast(new FootballScoreUpdated($score_total));
        return redirect('/score/update')->with('success', 'Score updated successfully!');
    }
}
