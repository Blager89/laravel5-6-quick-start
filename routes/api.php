<?php

Route::post('/signup','AuthController@signup');
Route::post('/login','AuthController@login');

Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
});
Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');