<?php

namespace App\ViewComposers;

use App\Coin;
use App\Library\CoinRepository;
use App\Library\Consts;
use App\Library\Helper;
use App\Library\PageRepository;
use Cache;
use Illuminate\View\View;

class DefaultViewComposer
{
    private function register(View $view, $setting)
    {
        $view->with(strtolower($setting), setting($setting));
    }

    /**
     * Bind data with view
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('theme_color', setting(Consts::THEME_COLOR, 'blue'));
        $view->with('coins_count', Cache::remember('coins_count', Consts::CACHE_DURATION_LONG, function () {
            return number_format(Coin::count());
        }));
        $view->with(Consts::SESSION_MAX_COINS, session(Consts::SESSION_MAX_COINS, 10));
        $view->with(strtolower(Consts::APP_NAME), setting(Consts::APP_NAME, 'CoinIndex'));
        $view->with('ga_id', setting(Consts::GOOGLE_ANALYTICS_ID));
        $this->register($view, Consts::ADSENSE_PUB_ID);
        $this->register($view, Consts::ADSENSE_SLOT1_ID);
        $this->register($view, Consts::ADSENSE_SLOT2_ID);
        $this->register($view, Consts::DONATE_BTC);
        $this->register($view, Consts::DONATE_ETH);
        $this->register($view, Consts::DONATE_LTC);
        $view->with('show_donate_button',
            (setting(Consts::DONATE_BTC) !== null) &&
            (setting(Consts::DONATE_ETH) !== null) &&
            (setting(Consts::DONATE_LTC) !== null));
        $view->with('has_affiliate_links', Helper::hasAffiliateLinks());
        $view->with('disqus_enabled', setting(Consts::ENABLE_DISQUS, false));
        $view->with('coins_approx', CoinRepository::approxCoinCount());
        $view->with('has_blog_posts', PageRepository::blogPostsCount() > 0);
    }
}