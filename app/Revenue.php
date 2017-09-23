<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = ['fight_id', 'revenue', 'viewers', 'attendance', 'game_id'];

    public function fight()
    {
        return $this->belongsTo(Fight::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function chartRevenue()
    {
    	return $this->where('game_id', auth()-user()->game->id)->pluck('revenue')->take(5);
    }
}
