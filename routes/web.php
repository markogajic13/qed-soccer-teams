<?php

use App\Models\League;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    $leagues = League::factory()->count(10)->make(['test' => '123'])->toArray();
    foreach ($leagues as $index => $league) {
        $leagues[$index]['id'] = $index + 1;
     }
    return $leagues;
});