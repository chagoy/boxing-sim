<?php

namespace App\Http\Controllers;

use App\Game;
use App\Fight;
use App\Boxer;
use App\Result;
use App\Network;
use App\Revenue;
use App\Location;

use Illuminate\Http\Request;

class FightsController extends Controller
{
    private $winner;
    private $loser;
    private $a_scorecard = 0;
    private $b_scorecard = 0;
    private $method;
    private $retirement;
    private $attendance;
    private $viewers;

    public function show(Game $game, Fight $fight)
    {
        return $fight;
    }

    public function update(Fight $fight, $a, $b)
    {
        //assign variables
        $aside = Boxer::find($a);
        $bside = Boxer::find($b);

        //add validation for the fight existing



        //compute logic to find out who wins
        $this->generateAWinner($aside, $bside);

        //tax the fight
        $aside->update([
            'contract' => \DB::raw('contract - 1')
            ]);

        $network = Network::where('id', $fight->card->network_id)->first();
        $winner = Boxer::where('id', $this->winner->id)->first();
        $loser = Boxer::where('id', $this->loser->id)->first();
        $location = Location::where('id', $fight->card->location_id)->first();

        // we figure out how much money the fight has generated
        $revenue = round((($winner->overall + $loser->overall) * $network->popularity) * 2170) * rand(1, 3);

        $popularAvg = ($winner->popularity + $loser->popularity / 2);

        if ($popularAvg > 85) {
            $this->attendance = $location->capacity;
        } else {
            $this->attendance = ($popularAvg + 15) / 100 * $location->capacity;
        }

        //add the record into the revenue table so we can keep track of that
        Revenue::create([
            'fight_id' => $fight->id,
            'game_id' => auth()->user()->game->id,
            'revenue' => $revenue,
            'attendance' => $this->attendance,
            'viewers' => round((($popularAvg + $network->popularity) / 2) * 3333)
        ]);

        // update the boxers table, mark the fight and card as completed
        \DB::table('cards')->where('id', $fight->card->id)->update([
            'completed' => 1
        ]);
        \DB::table('boxers')->where('id', $this->winner->id)->update([
            'win' => \DB::raw('win + 1'),
            'popularity' => \DB::raw('popularity + 3'),
            'power' => \DB::raw('power - 1'),
            'speed' => \DB::raw('speed - 1'),
            'stamina' => \DB::raw('stamina - 2'),
            'offense' => \DB::raw('offense - 1'),
            'defense' => \DB::raw('defense - 1'),
            'chin' => \DB::raw('chin - 1'),
            'health' => \DB::raw('health - 1')
        ]);

        \DB::table('boxers')->where('id', $this->loser->id)->update([
            'loss' => \DB::raw('loss + 1'),
            'popularity' => \DB::raw('popularity - 2'),
            'power' => \DB::raw('power - 3'),
            'speed' => \DB::raw('speed - 3'),
            'stamina' => \DB::raw('stamina - 2'),
            'offense' => \DB::raw('offense - 3'),
            'defense' => \DB::raw('defense - 3'),
            'chin' => \DB::raw('chin - 3'),
            'health' => \DB::raw('health - 2')
        ]);

        \DB::table('fights')->where('id', $fight->id)->update([
            'completed' => 1
        ]);

         //create the entry in the results table
        Result::create([
            'game_id' => auth()->user()->game->id,
            'fight_id' => $fight->id,
            'winner' => $this->winner->id,
            'loser' => $this->loser->id,
            'method' => $this->method
        ]);

        $userMoney = auth()->user()->game->money;

        if ($this->winner->promoter_id === 1 && $this->loser->promoter_id === 1) {
            auth()->user()->game->update([
                'money' => ($revenue * .25) + $userMoney
            ]);
        } elseif ($this->winner->promoter_id === 1 || $this->loser->promoter_id === 1) {
            auth()->user()->game->update([
                'money' => ($revenue * .12) + $userMoney
            ]);
        };

        $this->checkRetirement($this->winner, $this->loser);
        $this->checkContract($this->winner);
        $this->checkContract($this->loser);
        auth()->user()->game->nextDay();

        $description = $this->method . '. The card generated ' . number_format($revenue) . ' in net revenue.' . $this->retirement . ' ' . $this->winner->name . ' earned $' . number_format($revenue * .35) . ' while $' . number_format($revenue * .14) . ' went to ' . $this->loser->name;

        return redirect('/home')->with('flash', $description);
    }

    public function checkContract($a)
    {
        $boxer = Boxer::where('id', $a->id)->first();
        if ($boxer->contract === 0) {
            $boxer->update([
                'promoter_id' => 4
            ]);
        }
    }

    public function checkRetirement($a, $b)
    {
        if ($a->health < 15 || $a->popularity < 15 || $a->speed < 5 || $a->power < 5 || $a->stamina < 5 || $a->offense < 15 || $a->defense < 15 || $a->chin < 15) {
            $a->update([
               'contract' => 0,
               'promoter_id' => 0,
            ]);
            $this->retirement = ' ' . $a->name . ' has announced his retirement post-fight.';
        }
        if ($b->health < 15 || $b->popularity < 15 || $b->speed < 5 || $b->power < 5 || $b->stamina < 5 || $b->offense < 15 || $b->defense < 15 || $b->chin < 15) {
            $b->update([
                'contact' => 0,
                'promoter_id' => 0
            ]);
            $this->retirement .= ' ' . $b->name . ' is officially retiring.';
        }
    }

    public function generateAWinner($a, $b)
    {
        for ($i = 1; $i < 13; $i++) {
            if ($a->fightRating() - $b->fightRating() > 55 && $b->chin < 70) {
                $this->method = $a->name . ' knocked out ' . $b->name;
                \DB::table('boxers')->where('id', $a->id)->increment('knockouts');
                $this->winner = $a;
                $this->loser = $b;
                return;
            } elseif ($a->fightRating() > $b->fightRating()) {
                $this->a_scorecard += 1;
            } elseif ($b->fightRating() - $a->fightRating() > 55 && $a->chin < 70) {
                $this->method = $b->name . ' knocked out ' . $a->name;
                \DB::table('boxers')->where('id', $b->id)->increment('knockouts');
                $this->winner = $b;
                $this->loser = $a;
                return;
            } elseif ($b->fightRating() > $a->fightRating()) {
                $this->b_scorecard += 1;
            } else $this->a_scorecard += 1;
        }

        if ($this->a_scorecard > $this->b_scorecard) {
            $this->winner = $a;
            $this->loser = $b;
            $this->method = $a->name . ' decisions ' . $b->name . ' with an average score of '. (120 - $this->b_scorecard) .'-'. (120 - $this->a_scorecard);
        } else {
            $this->winner = $b;
            $this->loser = $a;
            $this->method = $b->name . ' decisions ' . $a->name . ' with an average score of '. (120 - $this->a_scorecard) .'-'. (120 - $this->b_scorecard);
        }
    }
}
