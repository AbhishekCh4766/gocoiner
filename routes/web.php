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

Route::group(['namespace' => 'Backend', 'as' => 'private.', 'prefix' => 'private', 'middleware' => 'auth'], function () {
    include __DIR__ . '/backend.php';
});

Route::group(['namespace' => 'Auth', 'as' => 'auth.', 'prefix' => 'auth'], function () {
    include __DIR__ . '/auth.php';
});

/************** Backend Middleware ************/

 
// Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){

// Route::group(['namespace' => 'Backend', 'as' => 'private.', 'prefix' => 'auth'], function () {
//     include __DIR__ . '/backend.php';
// });

// });
/********** Frontend Login ***********/


Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function(){
Route::group(['namespace' => 'Frontend'], function () {
    include __DIR__ . '/frontend.php';
    Route::get('/myportfolio', 'PortfolioController@index' );
    Route::get('/post_login', 'PortfolioController@index');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::any('/add_portfolio', 'PortfolioController@store');
});
});

Route::get('/login/{social}','Frontend\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback','Frontend\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

