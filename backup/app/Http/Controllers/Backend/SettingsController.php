<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Library\Dotenv\EnvManager;
use App\Library\Helper;
use App\Library\Languages;
use Illuminate\Http\Request;
use Setting;

class SettingsController extends Controller
{
    public function index()
    {
        return view('backend.settings');
    }

    private static function redirect()
    {
        return redirect()->route('admin.settings');
    }

    private static function updateSetting($key, $value)
    {
        if (!empty($value)) {
            Setting::set($key, $value);
        } else {
            Setting::forget($key);
        }
    }

    private static function updateBooleanSetting($key, $value)
    {
        if ($value !== null) {
            Setting::set($key, (bool)$value);
        } else {
            Setting::set($key, false);
        }
    }

    private static function updateIntegerSetting($key, $value)
    {
        if (\is_numeric($value) && $value != null) {
            Setting::set($key, (int)$value);
        } else {
            Setting::forget($key);
        }
    }

    private static function updatePrecisionSetting($key, $value)
    {
        if ($value == null || $value < 0 || $value > 6) {
            $value = 2;
        }
        Setting::set($key, $value);
    }

    public function storeGeneralSettings(Request $request)
    {
        $request->validate([
            Consts::APP_NAME => 'required',
            Consts::APP_URL => 'required|url',
            Consts::ADMIN_EMAIL => 'required|email',
            Consts::THEME_COLOR => 'required|in:blue,purple,cyan,green,red',
        ]);

        self::updateSetting(Consts::APP_NAME, $request->get(Consts::APP_NAME, Consts::DEFAULT_APP_NAME));
        self::updateSetting(Consts::APP_URL, $request->get(Consts::APP_URL));

        $locale = Languages::validateLocale($request->get(Consts::APP_LOCALE));
        self::updateSetting(Consts::APP_LOCALE, $locale);

        self::updateSetting(Consts::ADMIN_EMAIL, $request->get(Consts::ADMIN_EMAIL));
        self::updateSetting(Consts::THEME_COLOR, $request->get(Consts::THEME_COLOR));
        self::updateBooleanSetting(Consts::ENABLE_REGISTRATION, $request->get(Consts::ENABLE_REGISTRATION));

        self::updateIntegerSetting(Consts::COIN_LIST_COUNT, $request->get(Consts::COIN_LIST_COUNT, 10));
        self::updateIntegerSetting(Consts::ARTICLE_LIST_COUNT, $request->get(Consts::ARTICLE_LIST_COUNT, 10));

        self::updatePrecisionSetting(Consts::PRECISION_CURRENCY, $request->get(Consts::PRECISION_CURRENCY));
        self::updatePrecisionSetting(Consts::PRECISION_PERCENT, $request->get(Consts::PRECISION_PERCENT));

        self::updateSetting(Consts::DISQUS_USERNAME, $request->get(Consts::DISQUS_USERNAME));
        self::updateBooleanSetting(Consts::ENABLE_DISQUS, !blank($request->get(Consts::DISQUS_USERNAME)) && (bool)$request->get(Consts::ENABLE_DISQUS));

        self::saveSettings(true);

        flash()->success('General settings updated')->important();
        return self::redirect();
    }

    public function storeMonetizationSettings(Request $request)
    {
        self::updateSetting(Consts::ADSENSE_PUB_ID, $request->get(Consts::ADSENSE_PUB_ID));
        self::updateSetting(Consts::ADSENSE_SLOT1_ID, $request->get(Consts::ADSENSE_SLOT1_ID));
        self::updateSetting(Consts::ADSENSE_SLOT2_ID, $request->get(Consts::ADSENSE_SLOT2_ID));
        self::updateSetting(Consts::DONATE_BTC, $request->get(Consts::DONATE_BTC));
        self::updateSetting(Consts::DONATE_ETH, $request->get(Consts::DONATE_ETH));
        self::updateSetting(Consts::DONATE_LTC, $request->get(Consts::DONATE_LTC));

        $pieces = Helper::stringToArray($request->get(Consts::AFFILIATE_LINKS));
        self::updateSetting(Consts::AFFILIATE_LINKS, implode("\n", $pieces));

        Setting::save();
        setting_refresh();

        flash()->success('Monetization settings updated')->important();
        return self::redirect();
    }

    public function storeSystemSettings(Request $request)
    {
        #flash()->success('System settings updated')->important();
        flash()->success('Not implemented', 'warning')->important();
        return self::redirect();
    }

    public function storeCustomizationSettings(Request $request)
    {
        self::updateSetting(Consts::CUSTOM_CSS, trim($request->get(Consts::CUSTOM_CSS)));
        self::updateSetting(Consts::CUSTOM_JS, trim($request->get(Consts::CUSTOM_JS)));

        self::saveSettings(false);

        flash()->success('Customization settings updated')->important();
        return self::redirect();
    }

    public function storeSeoSettings(Request $request)
    {
        self::updateSetting(Consts::GOOGLE_ANALYTICS_ID, $request->get(Consts::GOOGLE_ANALYTICS_ID));
        self::updateBooleanSetting(Consts::ENABLE_PAGE_SPEED, $request->get(Consts::ENABLE_PAGE_SPEED));

        self::updateSetting(Consts::COIN_URL_PREFIX, trim($request->get(Consts::COIN_URL_PREFIX, Consts::DEFAULT_COIN_URL_PREFIX)));
        self::updateSetting(Consts::COIN_URL_SUFFIX, trim($request->get(Consts::COIN_URL_SUFFIX)));

        self::updateSetting(Consts::COIN_PAGE_TITLE, trim($request->get(Consts::COIN_PAGE_TITLE)));
        self::updateSetting(Consts::GENERAL_PAGE_TITLE, trim($request->get(Consts::GENERAL_PAGE_TITLE)));
        self::updateSetting(Consts::META_KEYWORDS, trim($request->get(Consts::META_KEYWORDS)));
        self::updateSetting(Consts::META_DESCRIPTION, trim($request->get(Consts::META_DESCRIPTION)));

        self::saveSettings(true);

        flash()->success('SEO settings updated')->important();
        return self::redirect();
    }

    private static function saveSettings($writeDotEnv = false)
    {
        Setting::save();
        setting_refresh();

        if ($writeDotEnv) {
            self::updateEnvFile();
        }
    }

    private static function updateEnvFile()
    {
        $env_path = BASE_DIR . '/.env';

        EnvManager::load($env_path);

        EnvManager::set(Consts::APP_NAME, setting(Consts::APP_NAME));
        EnvManager::set(Consts::APP_URL, setting(Consts::APP_URL));
        EnvManager::set(Consts::APP_LOCALE, setting(Consts::APP_LOCALE));
        EnvManager::set(Consts::ADMIN_EMAIL, setting(Consts::ADMIN_EMAIL));
        EnvManager::set(Consts::ENABLE_PAGE_SPEED, (bool)setting(Consts::ENABLE_PAGE_SPEED));
        EnvManager::set(Consts::ENABLE_REGISTRATION, (bool)setting(Consts::ENABLE_REGISTRATION));
        EnvManager::set(Consts::COIN_URL_PREFIX, setting(Consts::COIN_URL_PREFIX));

        EnvManager::save($env_path, true);
    }
}