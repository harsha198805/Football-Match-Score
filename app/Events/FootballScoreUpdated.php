<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Score;

class FootballScoreUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $score;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($score)
    {
       
       // $this->score = $score;
        $score = Score::latest()->first();
        $score_total = [
            'teamA' => $score->team_a_score??0,
            'teamB' => $score->team_b_score??0,
            'status' => $score->status??'Not Started',
        ];
        $score = $score_total;
    
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('football-score');
    }


    public function broadcastWith()
    {

        $score = Score::latest()->first();
        $score_total = [
            'teamA' => $score->team_a_score??0,
            'teamB' => $score->team_b_score??0,
            'status' => $score->status??'Not Started',
        ];
        return $score_total;
    }

    public function broadcastAs()
    {
        return 'score-updated';
    }
}
