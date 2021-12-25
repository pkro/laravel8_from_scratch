<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/peer', function () {
    return view('peer');
});

Route::get('/noview', function () {
    return "hey hey my my";
});

Route::get('/givemesomejson', function () {
    // this array gets automatically converted to JSON
    return ['here' => ['you', 'have', 'some', 'json']];
});

Route::get('/', function () {
    return view('welcome');
});




