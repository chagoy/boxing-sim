<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class DatesController extends Controller
{
    public function create()
    {
    	if ($card = Card::where('date', auth()->user()->game->date)->where('game_id', auth()->user()->game->id)->first()) {
    		return view('cards.show', compact('card'));
    	} else {
    		auth()->user()->game->nextDay();
			return redirect('/home')->with('flash', 'title');
    	}
    }
}
