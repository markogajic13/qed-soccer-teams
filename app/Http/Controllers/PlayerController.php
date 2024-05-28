<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerResourceCollection;
use App\Http\Resources\TeamResourceCollection;
use App\Models\League;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $players = Player::paginate(10); 
        return new PlayerResourceCollection($players);
    }

    public function getPlayersByTeam(Team $team)
    {
        $players = $team->players()->paginate(10);
        return new TeamResourceCollection($players);
    }

    public function getPlayersByLeague(League $league)
    {
        $players = $league->players()->paginate(10);
        return new PlayerResourceCollection($players);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
