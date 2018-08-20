    <?php

    use App\Library\Consts;
    use App\NewsCryptoo;

    $coin_url_prefix = env(Consts::COIN_URL_PREFIX);
    if (blank($coin_url_prefix)) {
    $coin_url_prefix = Consts::DEFAULT_COIN_URL_PREFIX;
    }

Route::get('/login/{social}','LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback','LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

    Route::group(['as' => 'home.'], function () use ($coin_url_prefix) {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('market', 'HomeController@market')->name('market');
    Route::get('market/page/{size}', 'HomeController@setPageSize')->name('market.pageSize');
    Route::get($coin_url_prefix . '/{symbol}', 'HomeController@coin')->name('coin.canonical');
    Route::get($coin_url_prefix . '/{symbol}/{slug?}/', 'HomeController@coin')->name('coin');
    Route::get('search', 'HomeController@search')->name('search');
    Route::get('cron', 'HomeController@cron')->name('cron');
    Route::get('reset', 'HomeController@reset')->name('reset');
    });

    Route::group(['as' => 'static.'], function () {
    Route::get('terms', 'HomeController@terms')->name('terms');
    Route::get('privacy', 'HomeController@privacy')->name('privacy');
    Route::get('disclaimer', 'HomeController@disclaimer')->name('disclaimer');
    });

    Route::group(['as' => 'contact.', 'prefix' => 'contact'], function () {
    Route::get('/', 'ContactController@index')->name('index');
    Route::post('store', 'ContactController@store')->name('store');
    });

    Route::group(['as' => 'news.', 'prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index')->name('index');
    Route::get('go/{id}', 'NewsController@go')->name('go');
    Route::get('/search_news','NewsController@search')->name('search_news');

    });

    Route::group(['as' => 'pages.', 'prefix' => 'page'], function () {
    Route::get('/', 'PageController@index')->name('index');
    Route::get('{slug}', 'PageController@show')->name('show');
    });

    Route::group(['as' => 'api.', 'prefix' => 'api'], function () {
    Route::post('history/', 'ApiController@history')->name('history');
    });

    Route::group(['prefix' => 'sitemap', 'as' => 'sitemap.'], function () {
    Route::get('/', 'SitemapController@html')->name('index');
    Route::get('html', 'SitemapController@html')->name('html');
    Route::get('xml', 'SitemapController@xml')->name('xml');
    Route::get('txt', 'SitemapController@txt')->name('txt');
    });

    // Route::group(['as' => 'menu.', 'prefix' => 'page'], function () {
    // Route::get('{id}/{slug}', 'HomeController@menu')->name('link');
    // });

    Route::get('template', 'HomeController@template');
    Route::any('auto_complete','HomeController@getAutoCompleteData');

    Route::get('crypto-ico/{type}', 'CryptoIcoController@index');


    /***************  News Xml  ************/ 
    Route::any('saveEthData','NewsController@saveEthData');
    Route::any('saveRipData','NewsController@saveRipData');
    Route::any('saveicoData','NewsController@saveicoData');
    Route::any('saveBloData','NewsController@saveBloData');
    Route::any('saveBitData','NewsController@saveBitData');
    Route::any('saveFeaData','NewsController@saveFeaData');


    /********** Upcoming Events *********/


    Route::get('/event-calendar', 'EventsController@index');

    Route::post('testme', 'NewsController@search');

    Route::get('demos/livesearch','NewsController@search'); 

    Route::get('/thermogram', 'ThermogramController@index' );

    Route::get('/registration', 'RegistrationController@index' );
    Route::post('/registration_page', 'RegistrationController@store' );


    Route::get('/login', 'HomeController@login' );
    Route::post('/post_login', 'LoginController@authenticate' );
    /*************** Press Release ************/
    Route::get('/press-release', 'PressReleaseController@index' );
    Route::get('/press-release/{id}', 'PressReleaseController@details' );

    /*************** Portfolio ***************/

    Route::get('/myportfolio', 'PortfolioController@index' );
    Route::get('/recommendations', 'PortfolioController@recommend' );
    Route::get('recommendations/{abc}', 'PortfolioController@details' );
    Route::any('deleteportfolio', 'PortfolioController@deleteportfolio' );


    Route::post('/getcoindetails','PortfolioController@getcoindetails');

     /*************** Advertising ***************/
    Route::get('/advertising', 'PageController@advertising' );
    Route::get('/getICOs', 'IcoWatchListApiController@getICOs' );

    /************* Password Reset ************/
    Route::get('/reset-password', 'ResetPasswordController@reset' );
    Route::post('/send_link', 'ResetPasswordController@sendResetLinkEmail' );  
    Route::get('/verify/{id}', 'ResetPasswordController@reset_form' );
    Route::post('/save-password/{id}', 'ResetPasswordController@update_password');


  