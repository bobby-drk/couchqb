<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends ApiController
{
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
        ]);

        $game = new Game;
        $game->moderator = $request->input('user_id');
        $game->key = str_random(40);
        $game->save();

        return $this->setStatusCode(201)->respond([
            'data' => $game
        ]);
    }
}
