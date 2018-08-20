<?php
/**
 * Consts.php
 *
 * @author     Dr. Max Ehsan <max@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;

class Consts
{
    const CACHE_DURATION_TINY = 2;
    const CACHE_DURATION_SMALL = 5;
    const CACHE_DURATION_MEDIUM = 10;
    const CACHE_DURATION_LONG = 15;
    const COINDATA_REFRESH_INTERVAL = 10;
    const NEWS_REFRESH_INTERVAL = 60;

    const SESSION_MAX_COINS = 'maxcoins';

    const APP_NAME = 'APP_NAME';
    const APP_URL = 'APP_URL';
    const APP_LOCALE = 'APP_LOCALE';
    const THEME_COLOR = 'THEME_COLOR';
    const ADMIN_EMAIL = 'ADMIN_EMAIL';
    const ENABLE_REGISTRATION = 'ENABLE_REGISTRATION';
    const ENABLE_PAGE_SPEED = 'ENABLE_PAGE_SPEED';

    const META_KEYWORDS = 'META_KEYWORDS';
    const META_DESCRIPTION = 'META_DESCRIPTION';
    const COIN_PAGE_TITLE = 'COIN_PAGE_TITLE';
    const GENERAL_PAGE_TITLE = 'GENERAL_PAGE_TITLE';
    const COIN_URL_PREFIX = 'COIN_URL_PREFIX';
    const COIN_URL_SUFFIX = 'COIN_URL_SUFFIX';

    const GOOGLE_ANALYTICS_ID = 'GOOGLE_ANALYTICS_ID';
    const ADSENSE_PUB_ID = 'ADSENSE_PUB_ID';
    const ADSENSE_SLOT1_ID = 'ADSENSE_SLOT1_ID';
    const ADSENSE_SLOT2_ID = 'ADSENSE_SLOT2_ID';
    const AFFILIATE_LINKS = 'AFFILIATE_LINKS';

    const DONATE_BTC = 'DONATE_BTC';
    const DONATE_ETH = 'DONATE_ETH';
    const DONATE_LTC = 'DONATE_LTC';

    const PRECISION_CURRENCY = 'PRECISION_CURRENCY';
    const PRECISION_PERCENT = 'PRECISION_PERCENT';
    const TOP_MOVERS_VOLUME = 'TOP_MOVERS_VOLUME';

    const COIN_LIST_COUNT = 'COIN_LIST_COUNT';
    const ARTICLE_LIST_COUNT = 'ARTICLE_LIST_COUNT';

    const DISQUS_USERNAME = 'DISQUS_USERNAME';
    const ENABLE_DISQUS = 'ENABLE_DISQUS';

    const CUSTOM_CSS = 'CUSTOM_CSS';
    const CUSTOM_JS = 'CUSTOM_JS';

    const DEFAULT_APP_NAME = 'CoinIndex';

    const PAGE_TYPE_POST = 'post';
    const PAGE_TYPE_CUSTOM = 'custom';

    const DEFAULT_COIN_URL_PREFIX = 'coin';
}