<?php

namespace App;

use App\Game;
use App\Fight;
use App\Network;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['network_id', 'game_id', 'headline', 'completed', 'location_id', 'date'];

    protected $with = ['fights'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function fights()
    {
        return $this->hasMany(Fight::class);
    }

    public function network()
    {
        return $this->hasOne(Network::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    protected function getNetworkAttribute()
    {
        return Network::where('id', $this->network_id)->first()->name;
    }
}
