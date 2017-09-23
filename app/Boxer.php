<?php

namespace App;

use App\Game;
use App\Fight;

use Illuminate\Database\Eloquent\Model;

class Boxer extends Model
{
    protected $fillable = ['promoter_id', 'stamina', 'offense', 'defense', 'power', 'speed', 'chin', 'win', 'loss', 'knockouts', 'draws', 'health', 'chin', 'game_id', 'popularity', 'name', 'division'];

    protected $appends = ['cost', 'overall'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function fights()
    {
        return Fight::where('a_side', $this->id)->orWhere('b_side', $this->id)->get();
    }

    public function overall()
    {
        return round(($this->speed + $this->power + $this->offense + $this->defense + + $this->stamina) / 5);
    }

    public function upgrade()
    {
        auth()->user()->game()->update([
            'money' => \DB::raw('money - 500000')
        ]);

        $this->update([
            'power' => \DB::raw('power + 1'),
            'speed' => \DB::raw('speed + 1'),
            'chin' => \DB::raw('chin + 1'),
            'stamina' => \DB::raw('stamina + 1'),
            'offense' => \DB::raw('offense + 1'),
            'defense' => \DB::raw('defense + 1')
        ]);
    }

    public function fightRating()
    {
        return round($this->overall() * rand(11, 15.5) / 10);
    }

    public function popularity()
    {
        return round(($this->popularity + 5) * 0.85);
    }

    public function cost()
    {
        return round(($this->overall() + $this->popularity())) * 55000;
    }

    protected function getOverallAttribute()
    {
        return round(($this->speed + $this->power + $this->offense + $this->defense + $this->stamina) / 5);
    }

    protected function getCostAttribute()
    {
        return '$'.number_format(round(($this->overall() + $this->popularity()) * 0.71) * 55000);
    }

    protected function getKopctAttribute()
    {
        if ($this->win + $this->loss + $this->draws) {
            return round($this->knockouts / ($this->win + $this->loss + $this->draws) * 100);
        } else {
            return 0;
        }
    }
}
