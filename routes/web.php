<?php

use Illuminate\Support\Facades\Route;
use Naykel\Gotime\RouteBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

(new RouteBuilder('nav-main'))->create();

// $path = base_path('database/retailers.json');
// $jsonFile = json_decode(file_get_contents($path));
// dd($jsonFile);