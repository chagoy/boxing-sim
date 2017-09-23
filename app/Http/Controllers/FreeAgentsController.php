<?php

namespace App\Http\Controllers;

use App\Boxer;
use Illuminate\Http\Request;

class FreeAgentsController extends Controller
{
    public function index()
    {
    	$boxers = auth()->user()->game->freeAgents();

        return view('freeagents.index', compact('boxers'));
    }
}
