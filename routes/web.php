<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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
