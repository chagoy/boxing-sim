<?php

namespace App\Http\Controllers;

use App\Boxer;
use App\Card;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxers = Boxer::where('promoter_id', 1)
                        ->where('game_id', auth()->user()->game->id)
                        ->orderBy('popularity')
                        ->take(5)
                        ->get();

        $results = auth()->user()->game->myRevenue();
        $viewers = auth()->user()->game->myViewers();
        $attendance = auth()->user()->game->myAttendance();
        
        return view('home', compact('boxers', 'results', 'viewers', 'attendance'));
    }
}
