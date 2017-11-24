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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('films.list');
});

Route::get('/login', function () {
    return redirect()->route('auth.login');
});

Route::get('films', 'Frontend\FilmsController@index')->name('films.list');
Route::get('films/detail/{slug}', 'Frontend\FilmsController@detail')->name('films.item');
Route::get('films/insert', 'Frontend\FilmsController@insert')->name('films.insert');

Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::post('register/save', 'Auth\RegisterController@save')->name('register.save');

Route::get('auth', function () {
    return redirect('/auth/login');
});

Route::get('auth/login', 'Auth\LoginController@index')->name('auth.login');
Route::post('auth/authenticate', 'Auth\LoginController@authenticate')->name('auth.authenticate');

Route::get('auth/logout', 'Auth\LoginController@logout')->name('auth.logout');
