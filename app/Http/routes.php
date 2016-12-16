<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route to homepage, that will render the news highlight with 10 items
Route::get('/', 'HomeController@index');

//Authentication handle
Route::auth();

//Route to rss feed
Route::get('rss', 'HomeController@feed')->name('rss');

//Generate PDF version of an article
Route::get('news/pdf/{id}', 'NewsController@getPdf');

//User activation link
Route::post('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user_activate');

//Set up password after signup
Route::get('user/setpass/{token}', 'Auth\AuthController@setPassword')->name('user_setpass');

//News publishing routing, all actions will be placed under NewsController
Route::group(['middleware' => ['auth']], function () {
	Route::controllers(['news'=> 'NewsController']);
});

//Link to a specified article, public to everyone
Route::get('{id}/{slug}', 'NewsController@getView');