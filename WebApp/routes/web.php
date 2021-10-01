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

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'update'])->middleware('auth');

Route::group([
    'prefix' => 'admin', 
    'as' => 'admin.', 
    'namespace' => 'Admin', 
    'middleware' => ['auth', 'twofactor']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
});

Route::get('verify/resend', 'App\Http\Controllers\Auth\TwoFactorController@resend')->name('verify.resend');

Route::resource('verify', 'App\Http\Controllers\Auth\TwoFactorController')->only(['index', 'store']);
