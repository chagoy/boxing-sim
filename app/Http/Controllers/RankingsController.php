<?php

namespace App\Http\Controllers;

use Auth;
use App\Boxer;
use Illuminate\Http\Request;

class RankingsController extends Controller
{
    public function index()
    {
        $p4p = Auth::user()->game->boxers->sortByDesc('overall')->take(10);

        $popular = Auth::user()->game->boxers->sortByDesc('cost')->take(10);

        $punchers = Auth::user()->game->boxers->sortByDesc('kopct')->take(10);

        return view('rankings.index', compact('p4p', 'popular', 'punchers'));
    }
}
