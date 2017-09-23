<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function show()
    {
    	$game = auth()->user()->game;

        return view('promotion.show', compact('game'));
    }
}
