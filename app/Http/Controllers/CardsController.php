<?php

namespace App\Http\Controllers;

use App\Location;
use App\Network;
use App\Boxer;
use App\Card;
use App\Fight;
use Auth;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function create()
    {
        $location = Location::get();

        $networks = Network::get();

        $userBoxers = Boxer::where('game_id', auth()->user()->game->id)->where('promoter_id', 1)->get();

        $boxers = Boxer::where('game_id', auth()->user()->game->id)->get();

        return view('cards.create', compact('networks', 'boxers', 'userBoxers', 'location'));
    }

    public function store()
    {
    	$a = Boxer::find(request('a_side'));
        $b = Boxer::find(request('b_side'));

        $date = request('date');
        $newdate = date("Y-m-d", strtotime($date));

        $card = Card::create([
            'network_id' => request('network'),
            'headline' => request('headline'),
            'location_id' => request('location'),
            'date' => $newdate,
            'game_id' => Auth::user()->game->id
        ]);

        $fight = Fight::create([
            'card_id' => $card->id,
            'game_id' => $card->game_id,
            'a_side' => request('a_side'),
            'b_side' => request('b_side')
        ]);

        $fight->boxers()->attach([
            request('a_side'),
            request('b_side')
        ]);

        // upfront cost from promoter
        \DB::table('games')->where('user_id', auth()->user()->id)->decrement('money', 400000);

        return back();
    }
}
