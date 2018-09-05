<?php

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

Route::get('/', function () {
    $user = new \App\Http\Models\User();
    $user->name = 'aa';
    $user->email = 'zah3@tlen.pl';
    $user->password = 'aaa';
    $user->activation_token = str_random(60);
    $user->save();
    $user->notify(new \App\Notifications\SignupActivate($user));
    return view('welcome');
});
