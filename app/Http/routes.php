<?php

//Route to homepage, that will render the news highlight with 10 items
Route::get('/', 'HomeController@index');

//Authentication handle
Route::auth();

//User activation link
Route::post('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user_activate');

//Set up password after signup
Route::get('user/setpass/{token}', 'Auth\AuthController@setPassword')->name('user_setpass');

//News publishing routing, all actions will be placed under NewsController
Route::group(['middleware' => ['auth']], function () {
	Route::controllers(['news'=> 'NewsController']);
	Route::controllers(['file'=> 'FileController']);
});
Route::group(['prefix' => 'filemanager','middleware' => 'auth'], function() {    
    Route::post('connectors', 'FilemanagerLaravelController@postConnectors');
	Route::get('show', 'FilemanagerLaravelController@getShow');
});
Route::get('connectors', 'FilemanagerLaravelController@getConnectors');
//Link to a specified article, public to everyone
Route::get('{id}/{slug}', 'NewsController@getView');