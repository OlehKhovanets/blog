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
//    dd('in notifier');
    dd(env("MICROSERVICE_MAILER", "http://nginx_mailer"));
    dd(\Illuminate\Support\Facades\Http::get('http://nginx_mailer'));
    dd(\App\Models\Job::query()->get()->toArray());
    return view('welcome');
});
