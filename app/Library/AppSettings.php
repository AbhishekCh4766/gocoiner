<?php
/**
 * SettingsRepository.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library;

/**
 * Class AppSettings
 * @package App\Library
 */
final class AppSettings
{
    private static $_data = [];
    private static $_instance = null;

    /**
     * SettingsRepository constructor.
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        if (!empty($data) && is_array($data)) {
            self::$_data = $data;
        }
    }

    /**
     * @param array $data
     * @return AppSettings
     */
    public static function instance(array $data = null)
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self($data);
        }
        return self::$_instance;
    }

    /**
     * Converts 'fooBar' to 'FOO_BAR'
     *
     * @param string $key
     * @return string
     */
    private static function normalizeKey($key)
    {
        return strtoupper(snake_case($key));
    }

    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    private function setAttr($key, $value)
    {
        self::$_data[self::normalizeKey($key)] = $value;
        //self::remember();
    }

    /**
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public function __get($key)
    {
        $key = self::normalizeKey($key);
        if (isset(self::$_data[$key])) {
            return self::$_data[$key];
        }

        $value = env($key);
        $this->setAttr($key, $value);
        return $value;
    }

    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    public function __set($key, $value)
    {
        $this->setAttr($key, $value);
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        $key = self::normalizeKey($key);
        return array_key_exists($key, self::$_data) && isset(self::$_data[$key]);
    }

    /**
     * @return string
     */
    public static function getCacheKey()
    {
        return '_coinindex_settings';
    }

    /**
     * @throws \Exception
     */
    public static function forget()
    {
        cache()->forget(self::getCacheKey());
    }

    /**
     * @throws \Exception
     */
    public static function remember()
    {
        cache()->rememberForever(self::getCacheKey(), function () {
            return self::$_data;
        });
    }
}