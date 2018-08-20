<?php
/**
 * frontendauth.php
 *
 * @author     Abhishek Choudhary <abhishek.allalgos@gmail.com>
 * @copyright  2018 
 */

use App\Library\Consts;

// Authentication Routes...
Route::get('login', 'FLoginController@showLoginForm')->name('login');
Route::post('login', 'FLoginController@login')->name('post_login');
Route::get('logout', 'FLoginController@logout')->name('logout');

// Registration Routes...
//if (env(Consts::ENABLE_REGISTRATION, false)) {
    Route::get('register', 'FRegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'FRegisterController@register')->name('post_register');
//}

// Password Reset Routes...
Route::get('password/reset', 'FForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'FForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'FResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'FResetPasswordController@reset')->name('password.post_reset');
