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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/close/{id}', 'HomeController@close')->name('close');
Route::post('/add','HomeController@add')->name('add');
Route::post('/addparticipant', 'VotingController@addParticipant')->name('addParticipant');
Route::get('/vote/{id}/{iduser}','VotingController@vote')->name('vote');
Route::get('/detail/{status}/{id}', 'VotingController@index')->name('participant');