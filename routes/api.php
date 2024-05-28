<?php

use App\Http\Controllers\LeagueController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/leagues', [LeagueController::class, 'index']);
Route::get('/teams', [TeamController::class, 'index']);
Route::get('/players', [PlayerController::class, 'index']);

Route::get('leagues/{league}/teams', [TeamController::class, 'getTeamsByLeague']);
Route::get('teams/{team}/players', [PlayerController::class, 'getPlayersByTeam']);
Route::get('leagues/{league}/players', [PlayerController::class, 'getPlayersByLeague']);



