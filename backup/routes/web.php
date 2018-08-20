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

Route::group(['namespace' => 'Frontend'], function () {
    include __DIR__ . '/frontend.php';
});

Route::group(['namespace' => 'Backend', 'as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    include __DIR__ . '/backend.php';
});

Route::group(['namespace' => 'Auth', 'as' => 'auth.', 'prefix' => 'auth'], function () {
    include __DIR__ . '/auth.php';
});

/********** Frontend Login ***********/

Route::group(['namespace' => 'FrontendAuth', 'as' => 'frontendauth.', 'prefix' => 'frontendauth'], function () {
    include __DIR__ . '/frontendauth.php';
});