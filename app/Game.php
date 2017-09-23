<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['user_id', 'popularity', 'money', 'date'];

    protected $appends = ['day', 'funds'];

    protected $with = ['cards'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function boxers()
    {
        return $this->hasMany(Boxer::class);
    }

    public function revenue()
    {
        return $this->hasMany(Revenue::class);
    }

    public function myRevenue()
    {
        return Revenue::where('game_id', $this->id)
                ->get()
                ->pluck('revenue');
    }

    public function myViewers()
    {
        return Revenue::where('game_id', $this->id)
                ->get()
                ->pluck('viewers');
    }

    public function myAttendance()
    {
        return Revenue::where('game_id', $this->id)
                ->get()
                ->pluck('attendance');
    }

    public function myBoxers()
    {
        return Boxer::where('game_id', $this->id)
            ->where('promoter_id', 1)
            ->orderBy('popularity', 'desc')
            ->get();
    }

    public function freeAgents()
    {
        return Boxer::where('game_id', auth()->user()->game->id)
            ->where('promoter_id', '>', 1)
            ->get();
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function upcomingCards()
    {
        return Card::where('game_id', auth()->user()->game->id)
            ->where('completed', 0)
            ->get();
    }

    public function fights()
    {
        return $this->hasMany(Fight::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function latestRevenue()
    {
        Card::where('game_id', auth()->user()->game->id)->where('promoter_id', 1);
    }
    public function latestResults()
    {
        return Result::where('game_id', auth()->user()->game->id)->latest()->take(10)->get();
    }

    public function getFundsAttribute()
    {
        return '$'.number_format($this->money);
    }

    public function getDayAttribute()
    {
        $dt = new DateTime($this->date);
        $carbon = Carbon::instance($dt);
        return $carbon->toFormattedDateString();
    }

    public function availableFights()
    {
        return Card::where('date', auth()->user()->game->date)->get();

    }

    public function nextDay()
    {
        $dt = new Carbon($this->date);

        $date = $dt->addDays(1);

        return $this->update([
            'date' => $date
        ]);
    }
}
