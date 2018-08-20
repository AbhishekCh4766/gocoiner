<?php
/**
 * helpers.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

use App\Library\SeoHelper;

define('SETTING_CACHE_KEY', '_settings_%$vr3k@fp4#');

if (!function_exists('setting')) {
    /**
     * Get configuration item
     *
     * @param string $key
     * @param null $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        // try the cache first
        try {
            $cached = cache()->get(SETTING_CACHE_KEY);
            if ($cached !== null && is_array($cached) && array_key_exists($key, (array)$cached)) {
                return $cached[$key];
            }
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }

        $value = Setting::get($key);

        if ($value == null && config('settings.fallback')) {
            $value = env($key);
        }

        if ($value !== null) {
            // update the settings database & cache
            Setting::set($key, $value);
            setting_remember();
        } else {
            $value = $default;
        }

        return $value;
    }
}

if (!function_exists('setting_remember')) {
    function setting_remember()
    {
        try {
            cache()->rememberForever(SETTING_CACHE_KEY, function () {
                return Setting::all();
            });
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('setting_forget')) {
    function setting_forget()
    {
        try {
            cache()->forget(SETTING_CACHE_KEY);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}

if (!function_exists('setting_refresh')) {
    function setting_refresh()
    {
        setting_forget();
        setting_remember();
    }
}

if (!function_exists('coin_url')) {
    /**
     * Generate URL for coin page
     *
     * @param \App\Coin $coin
     * @return string
     */
    function coin_url($coin)
    {
        $symbol = strtolower($coin->symbol);
        $slug = SeoHelper::slug($coin);
        return route('home.coin', [$symbol, $slug]);
    }
}

if (!function_exists('canonical_url')) {
    /**
     * Generate canonical URL
     *
     * @param $coin
     * @return string
     */
    function canonical_url($coin = null)
    {
        if ($coin == null) {
            return url()->current();
        }
        return route('home.coin.canonical', [strtolower($coin->symbol)], true);
    }
}