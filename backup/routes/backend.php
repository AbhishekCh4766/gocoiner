<?php
/**
 * backend.php
 *
 * @author     Dr. Max Ehsan <masroore@gmail.com>
 * @copyright  2017 Dr. Max Ehsan
 */

Route::get('/', 'AdminController@index')->name('index');

Route::get('settings', 'SettingsController@index')->name('settings');
Route::post('settings/gen', 'SettingsController@storeGeneralSettings')->name('settings_general');
Route::post('settings/mon', 'SettingsController@storeMonetizationSettings')->name('settings_monetization');
Route::post('settings/seo', 'SettingsController@storeSeoSettings')->name('settings_seo');
Route::post('settings/sys', 'SettingsController@storeSystemSettings')->name('settings_system');
Route::post('settings/cust', 'SettingsController@storeCustomizationSettings')->name('settings_customization');

Route::resource('coins', 'CoinController', ['only' => ['index', 'edit', 'update']]);

Route::get('pages/custom', 'PageController@custom')->name('pages.custom');
Route::resource('pages', 'PageController');


/*My route*/
Route::get('newses/press', 'NewsController@press')->name('newses.press');

Route::get('newses/create', 'NewsController@create')->name('newses.press');
Route::get('newses/custom', 'NewsController@custom')->name('newses.custom');
Route::post('newses/store', 'NewsController@store')->name('newses.store');
Route::post('newses/upsert', 'NewsController@upsert');
Route::post('newses/update/{id}', 'NewsController@update')->name('newses./update/{id}');
Route::post('newses/show', 'NewsController@show');
Route::post('newses/{id}/edit/', 'NewsController@edit')->name('newses./{id}/edit');
Route::post('newses/delete', 'NewsController@delete');
Route::resource('newses', 'NewsController');
/*end*/






Route::resource('menus', 'MenuController')->except(['show']);

Route::get('lang', 'LanguageController@index')->name('lang.index');
Route::get('lang/reseed', 'LanguageController@reseed')->name('lang.reseed');
Route::get('lang/{group}/reset', 'LanguageController@reset')->name('lang.reset');
Route::get('lang/{group}', 'LanguageController@edit')->name('lang.edit');
Route::post('lang', 'LanguageController@update')->name('lang.update');

Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@updateProfile')->name('profile_update');

Route::get('search', 'AdminController@search')->name('search');

Route::get('exec/{cmd}', 'AdminController@execute')->name('execute');