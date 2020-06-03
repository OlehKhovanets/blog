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

Route::get('/', function () {
    dd('in auth');
    return view('welcome');
});

Route::get('/users', function () {
    $user =  collect(['email' => 'ivan', 'id' => 3])->toJson();
//    dd($user);
    \Bschmitt\Amqp\Facades\Amqp::publish('routing-key', $user , ['queue' => 'queue-name']);
    dd('asdf');
    return App\User::all();
});
