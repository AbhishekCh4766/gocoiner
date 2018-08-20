<?php
/**
 * StringHelper.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library\Dotenv;

class StringHelper
{
    private static $bool_variants = ['true', 'false', 'yes', 'no'];

    public static function isBool($value)
    {
        return in_array(strtolower($value), self::$bool_variants);
    }

    public static function isBoolInString($value, $quoted_string, $word_count)
    {
        return is_bool($value) && ($quoted_string || $word_count >= 2);
    }

    public static function isNull($value)
    {
        return $value === 'null';
    }

    public static function isNumber($value)
    {
        return is_numeric($value);
    }

    public static function isString($value)
    {
        return self::startsWith('\'', $value) || self::startsWith('"', $value);
    }

    public static function isVariableClone($value, $matches, $quoted_string)
    {
        return (count($matches[0]) === 1) && $value == $matches[0][0] && !$quoted_string;
    }

    public static function startsWith($string, $line)
    {
        return $string === '' || strrpos($line, $string, -strlen($line)) !== false;
    }

    public static function startsWithNumber($line)
    {
        return is_numeric($line[0]);
    }

    public static function stripComments($value)
    {
        $value = explode(" #", $value, 2);
        return trim($value[0]);
    }
}