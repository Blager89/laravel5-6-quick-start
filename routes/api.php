<?php
Route::post('/signup', 'AuthController@signup');

Route::group(['middleware' => ['cors']], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/reset/password/email', 'AuthController@resetPasswordEmail');
});


Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
    Route::get('/user', 'AuthController@user');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/reset/password', 'AuthController@newPassword');
});


Route::group(['prefix' => 'admin'], function () {
    Route::post('/user','AdminController@users');

});
Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');




