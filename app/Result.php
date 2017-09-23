<?php

namespace App;

use App\Fight;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['game_id', 'fight_id', 'winner', 'loser', 'method'];

    public function fights()
    {
        return $this->belongsTo(Fight::class);
    }
}
