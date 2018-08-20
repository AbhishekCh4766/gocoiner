<?php
/**
 * Languages.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library;

use DB;
use Spatie\TranslationLoader\LanguageLine;

class Languages
{
    public static $languages = [
        'Albanian' => 'sq',
        'Arabic' => 'ar',
        'Bosnian' => 'bs',
        'Brazilian' => 'pt-BR',
        'Bulgarian' => 'bg',
        'Cambodian' => 'km',
        'Catalan' => 'ca',
        'Chinese' => 'zh-CN',
        'Chinese (Taiwan)' => 'zh-TW',
        'Chinese (Hong Kong)' => 'zh-HK',
        'Croatian' => 'hr',
        'Czech' => 'cs',
        'Danish' => 'da',
        'Dutch' => 'nl',
        'English' => 'en',
        'Farsi' => 'fa',
        'Finnish' => 'fi',
        'French' => 'fr',
        'German' => 'de',
        'Georgian' => 'ka',
        'Greek' => 'el',
        'Hebrew' => 'he',
        'Hungarian' => 'hu',
        'Icelandic' => 'is',
        'Indonesian' => 'id',
        'Italian' => 'it',
        'Japanese' => 'ja',
        'Korean' => 'ko',
        'Lithunian' => 'lt',
        'Macedonian' => 'mk',
        'Malay' => 'ms',
        'Montenegrin' => 'me',
        'Norwegian Bokmål' => 'nb',
        'Polish' => 'pl',
        'Portuguese' => 'pt',
        'Romanian' => 'ro',
        'Russian' => 'ru',
        'Sardinian' => 'sc',
        'Serbian' => 'sr',
        'Slovak' => 'sk',
        'Slovene' => 'sl',
        'Spanish' => 'es',
        'Swedish' => 'sv',
        'Thai' => 'th',
        'Turkish' => 'tr',
        'Turkmen' => 'tk',
        'Ukrainian' => 'uk',
        'Vietnamese' => 'vi',
    ];

    /**
     * Returns list of languages
     *
     * @return array
     */
    public static function languageChoices()
    {
        $langs = array_flip(self::$languages);
        foreach ($langs as $k => &$v) {
            $v = "$v ($k)";
        }
        return $langs;
    }

    /**
     * Returns a supported locale
     *
     * @param string $lang
     * @return string
     */
    public static function validateLocale($lang)
    {
        if (blank($lang)) {
            return config('app.fallback_locale');
        }
        return in_array(strtolower($lang), array_map('strtolower', array_values(self::$languages)))
            ? $lang
            : config('app.fallback_locale');
    }

    public static function seedSystem()
    {
        DB::table('language_lines')->whereGroup('system')->delete();

        LanguageLine::create([
            'group' => 'system',
            'key' => 'date',
            'text' => ['en' => 'Date',],
        ]);
        LanguageLine::create([
            'group' => 'system',
            'key' => 'updated',
            'text' => ['en' => 'Upated',],
        ]);
        LanguageLine::create([
            'group' => 'system',
            'key' => 'search_coins',
            'text' => ['en' => 'Search Coins',],
        ]);
    }

    public static function seedPagination()
    {
        DB::table('language_lines')->whereGroup('pagination')->delete();

        LanguageLine::create([
            'group' => 'pagination',
            'key' => 'previous',
            'text' => ['en' => 'Previous',],
        ]);
        LanguageLine::create([
            'group' => 'pagination',
            'key' => 'next',
            'text' => ['en' => 'Next',],
        ]);
    }

    public static function seedHome()
    {
        DB::table('language_lines')->whereGroup('home')->delete();

        LanguageLine::create([
            'group' => 'home',
            'key' => 'heading1',
            'text' => ['en' => 'Cryptocurrency monitoring done right!',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'heading2',
            'text' => ['en' => 'Monitor :coin_count cryptocurrencies. Get advanced alerts based on Buy, Sell, Volume and more.',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'description',
            'text' => ['en' => ':app_name is an interactive platform where you can analyze the latest Crypto trends and monitor all markets streaming in real time. View the latest Cryptocurrency price with our interactive and live price chart including market capitalization. Monitor the latest prices of :coin_count crypto-currencies on over 80 exchanges from all around the world. Track crypto currency value with automatic price tracker. Make cryptocurrency trading easy and profitable.',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'highest_grossing',
            'text' => ['en' => 'Highest Grossing Cryptocurrencies',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'top_gainers',
            'text' => ['en' => 'Daily Top Gainers',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'top_losers',
            'text' => ['en' => 'Daily Top Losers',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'view_market',
            'text' => ['en' => 'View Market Data',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'private',
            'text' => ['en' => 'Private',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'blog',
            'text' => ['en' => 'Blog',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'sitemap',
            'text' => ['en' => 'Sitemap',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'disclaimer',
            'text' => ['en' => 'Website Disclaimer',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'privacy',
            'text' => ['en' => 'Privacy Policy',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'terms',
            'text' => ['en' => 'Terms & Conditions',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'contact',
            'text' => ['en' => 'Contact Us',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'market',
            'text' => ['en' => 'Market',],
        ]);
        LanguageLine::create([
            'group' => 'home',
            'key' => 'site',
            'text' => ['en' => 'Site',],
        ]);
    }

    public static function seedCoin()
    {
        DB::table('language_lines')->whereGroup('coin')->delete();

        LanguageLine::create([
            'group' => 'coin',
            'key' => 'h1',
            'text' => ['en' => 'price, market cap & charts',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'price',
            'text' => ['en' => 'Price',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'currency',
            'text' => ['en' => 'Currency',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'name',
            'text' => ['en' => 'Name',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'change',
            'text' => ['en' => 'Change',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'mkt_share',
            'text' => ['en' => 'Mkt. Share',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'available_supply',
            'text' => ['en' => 'Available Supply',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'max_supply',
            'text' => ['en' => 'Max Supply',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'total_supply',
            'text' => ['en' => 'Total Supply',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'proof',
            'text' => ['en' => 'Proof',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'algorithm',
            'text' => ['en' => 'Algorithm',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'mkt_cap',
            'text' => ['en' => 'Mkt. Cap',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'market_cap',
            'text' => ['en' => 'Market Cap',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'volume',
            'text' => ['en' => 'Volume',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'volume_24h',
            'text' => ['en' => 'Volume 24H',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'change_1h',
            'text' => ['en' => 'Change % (1H)',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'change_24h',
            'text' => ['en' => 'Change % (24H)',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'change_7d',
            'text' => ['en' => 'Change % (7D)',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'affiliate_link',
            'text' => ['en' => 'Buy :coin_name',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'historical_chart',
            'text' => ['en' => ':coin_name (:coin_symbol) Historical Price & Volume Charts',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => '7d',
            'text' => ['en' => '7D',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => '1m',
            'text' => ['en' => '1M',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => '2m',
            'text' => ['en' => '2M',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => '3m',
            'text' => ['en' => '3M',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => '6m',
            'text' => ['en' => '6M',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => '1y',
            'text' => ['en' => '1Y',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'all',
            'text' => ['en' => 'All',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'info',
            'text' => ['en' => 'Information',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'kfi',
            'text' => ['en' => 'Key Financial Information',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'hist_data',
            'text' => ['en' => 'Historical Data',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'description',
            'text' => ['en' => 'Description',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'features',
            'text' => ['en' => 'Features',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'technology',
            'text' => ['en' => 'Technology',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'website',
            'text' => ['en' => 'Website',],
        ]);
        LanguageLine::create([
            'group' => 'coin',
            'key' => 'gen_date',
            'text' => ['en' => 'Genesis Date',],
        ]);
    }

    public static function seedNews()
    {
        DB::table('language_lines')->whereGroup('news')->delete();

        LanguageLine::create([
            'group' => 'news',
            'key' => 'news',
            'text' => ['en' => 'News',],
        ]);
        LanguageLine::create([
            'group' => 'news',
            'key' => 'page_title',
            'text' => ['en' => 'Cryptocurrency News',],
        ]);
        LanguageLine::create([
            'group' => 'news',
            'key' => 'read_more',
            'text' => ['en' => 'Read more',],
        ]);
    }

    public static function seedMarket()
    {
        DB::table('language_lines')->whereGroup('market')->delete();

        LanguageLine::create([
            'group' => 'market',
            'key' => 'heading',
            'text' => ['en' => 'Latest Cryptocurrency Prices & Market Capitalizations',],
        ]);
    }
}