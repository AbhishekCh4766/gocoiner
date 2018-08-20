<?php
/**
 * SeoHelper.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;

use App\Coin;

final class SeoHelper
{
    const META_DESCRIPTION_TEMPLATE = 'Live %%CRYPTO_NAME%% prices from all markets and %%CRYPTO_SYMBOL%% coin market Capitalization. Stay up to date with the latest %%CRYPTO_NAME%%  price movements and discussion. Check out our snapshot charts and see when there is an opportunity to buy or sell %%CRYPTO_NAME%%';
    const META_KEYWORDS_TEMPLATE = 'cryptocurrency,cryptocoin,bitcoin,ethereum,litecoin,market cap';
    const COIN_PAGE_TITLE_TEMPLATE = '%%CRYPTO_NAME%% (%%CRYPTO_SYMBOL%%) - Live %%CRYPTO_NAME%% price, charts and market capitalization';
    const COIN_URL_PREFIX = 'coin';
    const COIN_SLUG_TEMPLATE = '%%CRYPTO_NAME%% price, charts, market cap';
    const GENERAL_PAGE_TITLE_TEMPLATE = 'Live cryptocurrency prices, market capitalization, trades, volumes, news and reviews';

    /**
     * Renders template string
     *
     * @param string $template
     * @param Coin $coin
     * @return string
     */
    private static function render($template, $coin)
    {
        return str_replace(['%%CRYPTO_NAME%%', '%%CRYPTO_SYMBOL%%'], [$coin->name, $coin->symbol], $template);
    }

    public static function metaDescription($coin = null)
    {
        if (!isset($coin)) {
            return 'We bring you all the latest streaming pricing data in the world of cryptocurrencies. Whether you are just interested in the Bitcoin price or you want to see the latest Ethereum volume, we have all the data available at your fingertips. Join our website, get daily market updates and gain access to the latest news and best reviews in the cryptocurrency arena.';
        }

        $template = setting(Consts::META_DESCRIPTION, self::META_DESCRIPTION_TEMPLATE);
        $result = self::render($template, $coin);
        return $result;
    }

    public static function metaKeywords($coin = null)
    {
        $keywords = [];
        foreach (explode(',', strtolower(setting(Consts::META_KEYWORDS, self::META_KEYWORDS_TEMPLATE))) as $kw) {
            $kw = trim($kw);
            if (!blank($kw)) {
                $keywords[] = $kw;
            }
        }

        if (isset($coin)) {
            $name = strtolower($coin->name);
            if (!in_array($name, $keywords))
                $keywords[] = $name;
        }

        return implode(',', $keywords);
    }

    public static function title($coin = null)
    {
        if (isset($coin)) {
            $template = setting(Consts::COIN_PAGE_TITLE, self::COIN_PAGE_TITLE_TEMPLATE);
            return self::render($template, $coin);
        }
        return setting(Consts::GENERAL_PAGE_TITLE, self::GENERAL_PAGE_TITLE_TEMPLATE);
    }

    public static function slug($coin = null)
    {
        if (isset($coin)) {
            $template = setting(Consts::COIN_URL_SUFFIX, self::COIN_SLUG_TEMPLATE);
            return str_slug(self::render($template, $coin));
        }
        return str_slug('cryptocurrency price, charts, market cap');
    }
}