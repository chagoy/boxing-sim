<?php

namespace App\Http\Controllers;

use App\Boxer;
use App\Game;
use Illuminate\Http\Request;

class BoxersController extends Controller
{
    public function index()
    {
        $myBoxers = auth()->user()->game->myBoxers();

        return view('boxers.index', compact('myBoxers'));
    }

    public function show(Boxer $boxer)
    {
        return view('boxers.show', compact('boxer'));
    }

    public function store(Game $game, Boxer $boxer)
    {
    	if ($game->id === auth()->user()->game->id) {
            if (auth()->user()->game->money > request('money')) {
                $money = auth()->user()->game->money;
                auth()->user()->game->update([
                    'money' => $money - request('money')
                ]);
                $boxer->update([
                    'promoter_id' => 1,
                    'contract' => request('contract')
                ]);
                return true;
            } else return false;
        }
    }

    public function destroy(Boxer $boxer)
    {
        $boxer->update(['promoter_id' => 2]);
    }
}
