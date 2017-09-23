<?php

namespace App;

use App\Card;
use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    protected $fillable = ['a_side', 'b_side', 'card_id', 'complete', 'game_id'];

    protected $with = ['results', 'boxers', 'revenue'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function results()
    {
        return $this->hasOne(Result::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function revenue()
    {
        return $this->hasOne(Revenue::class);
    }

    public function boxers()
    {
        return $this->belongsToMany(Boxer::class, 'boxer_fight', 'fight_id', 'boxer_id');
    }
}
