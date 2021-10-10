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
    return redirect('/home');
});

Auth::routes();

Route::view('/home', 'home');

Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);

Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');

Route::view('/home/logged_in', 'home')->middleware('verified', 'twofactor', 'auth');

Route::get('/resume/{user}', 'ProfilesController@index')->name('profile.show');

Route::get('/resume/{user}/edit', 'ProfilesController@update')->middleware('auth');

Route::post('/resume/portfolio', 'PostsController@store');

Route::get('/resume/{user}/portfolio/create', 'PostsController@create')->middleware('auth');

Route::get('/resume/{user}/portfolio/{post}/update', 'PostsController@update')->middleware('auth');

Route::post('/resume/portfolio/{post}/updated', 'PostsController@updated')->middleware('auth');

Route::get('/resume/{user}/portfolio/{post}', 'PostsController@show');

Route::get('/resume/portfolio/{post}/delete', 'PostsController@delete')->middleware('auth');
