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

Route::view('/home/logged_in', 'home')->middleware('verified', 'twofactor');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

Route::get('/profile/{user}/edit', 'ProfilesController@update')->middleware('auth');

Route::get('/portfolio/create', 'PostsController@create');

Route::post('/portfolio', 'PostsController@store');

Route::group([
    'middleware' => ['auth', 'twofactor']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
});

Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');

Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);
