<?php
/**
 * EnvManager.php
 *
 * @author     Dr. Max Ehsan <masroore@gmail.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library\Dotenv;

class EnvManager
{
    // Laravel settings
    const APP_NAME = 'APP_NAME';
    const APP_ENV = 'APP_ENV';
    const APP_KEY = 'APP_KEY';
    const APP_DEBUG = 'APP_DEBUG';
    const APP_LOG_LEVEL = 'APP_LOG_LEVEL';
    const APP_URL = 'APP_URL';
    const DB_CONNECTION = 'DB_CONNECTION';
    const DB_HOST = 'DB_HOST';
    const DB_PORT = 'DB_PORT';
    const DB_DATABASE = 'DB_DATABASE';
    const DB_USERNAME = 'DB_USERNAME';
    const DB_PASSWORD = 'DB_PASSWORD';
    const BROADCAST_DRIVER = 'BROADCAST_DRIVER';
    const CACHE_DRIVER = 'CACHE_DRIVER';
    const SESSION_DRIVER = 'SESSION_DRIVER';
    const SESSION_LIFETIME = 'SESSION_LIFETIME';
    const QUEUE_DRIVER = 'QUEUE_DRIVER';
    const REDIS_HOST = 'REDIS_HOST';
    const REDIS_PASSWORD = 'REDIS_PASSWORD';
    const REDIS_PORT = 'REDIS_PORT';
    const MAIL_DRIVER = 'MAIL_DRIVER';
    const MAIL_HOST = 'MAIL_HOST';
    const MAIL_PORT = 'MAIL_PORT';
    const MAIL_USERNAME = 'MAIL_USERNAME';
    const MAIL_PASSWORD = 'MAIL_PASSWORD';
    const MAIL_ENCRYPTION = 'MAIL_ENCRYPTION';
    const PUSHER_APP_ID = 'PUSHER_APP_ID';
    const PUSHER_APP_KEY = 'PUSHER_APP_KEY';
    const PUSHER_APP_SECRET = 'PUSHER_APP_SECRET';

    private static $registry = [];

    public static function sanitizeKey(string $key): string
    {
        return strtoupper(trim($key));
    }

    public static function get(string $key, $value = null)
    {
        $key = self::sanitizeKey($key);
        return array_key_exists($key, self::$registry) ? self::$registry[$key] : $value;
    }

    public static function reset()
    {
        self::$registry = [];
    }

    public static function all(): array
    {
        return self::$registry;
    }

    public static function load(string $filepath)
    {
        throw_if(!is_readable($filepath) || ($contents = file_get_contents($filepath)) === false, \Exception::class, 'Error reading .env file: ' . $filepath);

        $config = EnvReader::parse($contents);

        array_walk($config, function ($v, $k) {
            self::set($k, $v);
        });
    }

    public static function set(string $key, $value)
    {
        self::$registry[self::sanitizeKey($key)] = $value;
    }

    public static function save(string $filepath, $sorted = false)
    {
        file_put_contents($filepath, self::generateEnvFileContent($sorted));
    }

    public static function setIfNull(string $key, $value)
    {
        $key = self::sanitizeKey($key);
        if (self::get($key) === null) {
            self::$registry[$key] = $value;
        }
    }

    public static function generateEnvFileContent(bool $sorted = false): string
    {
        self::setIfNull(EnvManager::APP_KEY, self::generate_key());

        $registry = self::$registry;
        if ($sorted) {
            ksort($registry);
        }

        $buffer = '';
        foreach ($registry as $k => $v) {
            if ($v === null) {
                $buffer .= $k . '=' . PHP_EOL;
            } else {
                $buffer .= sprintf('%s=%s%s', $k, self::formatValue($v), PHP_EOL);
            }
        }
        return $buffer;
    }

    public static function formatValue($s): string
    {
        if (is_bool($s)) {
            return $s ? 'true' : 'false';
        }

        if (is_numeric($s)) {
            return $s;
        }

        $s = trim($s);
        if (blank($s)) {
            return '';
        }
        return str_contains($s, [' ', "\t"]) ? sprintf('"%s"', $s) : $s;
    }

    public static function generate_key(): string
    {
        return 'base64:' . base64_encode(random_bytes(32));
    }
}