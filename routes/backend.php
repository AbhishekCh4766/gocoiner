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


/************** Recommendation  ***************/
Route::get('recommendation/recommendation', 'RecommendationController@recommendation')->name('recommendation.press');

Route::get('recommendation/create', 'RecommendationController@create')->name('recommendation.press');
Route::get('recommendation/custom', 'RecommendationController@custom')->name('recommendation.custom');
Route::post('recommendation/store', 'RecommendationController@store')->name('recommendation.store');
Route::post('recommendation/upsert', 'RecommendationController@upsert');
Route::post('recommendation/update/{id}', 'RecommendationController@update')->name('recommendation./update/{id}');
Route::post('recommendation/show', 'RecommendationController@show');
Route::post('recommendation/{id}/edit/', 'RecommendationController@edit')->name('recommendation./{id}/edit');
Route::post('recommendation/delete', 'RecommendationController@delete');
Route::resource('recommendation', 'RecommendationController');

/*****************  end *************/



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

/*****************  Slider *************/
Route::get('slider/index', 'SliderController@index')->name('slider.index');
Route::get('slider/create', 'SliderController@create')->name('slider.create');
Route::get('slider/custom', 'SliderController@custom')->name('slider.custom');
Route::post('slider/store', 'SliderController@store')->name('slider.store');
Route::post('slider/upsert', 'SliderController@upsert');
Route::post('slider/updateslider/{id}', 'SliderController@sliderup');
// Route::post('slider/updateslider/{id}', 'SliderController@update');
Route::post('slider/show', 'SliderController@show');
Route::post('slider/{id}/edit/', 'SliderController@edit')->name('slider./{id}/edit');
Route::post('slider/delete', 'SliderController@delete');
Route::resource('slider', 'SliderController');

/******************* Manage Users **************/
	Route::prefix('user')->group(function () {
			Route::get('index','UserController@index')->name('user.index');
			Route::get('add','UserController@add')->name('user.add');
			Route::post('store','UserController@store')->name('user.store');
			Route::get('delete/{id}','UserController@delete')->name('user.delete/{id}');
			Route::get('finaldelete/{id}','UserController@finaldelete')->name('user.finaldelete/{id}');
			Route::get('edit/{id}','UserController@edit')->name('user.edit/{id}');
			Route::post('update/{id}','UserController@update')->name('user.update/{id}');
			Route::get('deleted','UserController@deleted')->name('user.deleted');
			Route::get('restore/{id}','UserController@restore')->name('user.restore/{id}');
		});

// 	Route::post('slider/updateslider/{id}', function(){
// 	dd('dssdup');
// });