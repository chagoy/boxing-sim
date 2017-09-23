<?php

namespace App\Http\Controllers\Api;

use App\Boxer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoxersController extends Controller
{
	public function users()
	{
		return auth()->user()->game->myBoxers();
	}

    public function free()
    {
        return auth()->user()->game->freeAgents();
    }

    public function update(Boxer $boxer)
    {
        $boxer->upgrade();
    }
}
