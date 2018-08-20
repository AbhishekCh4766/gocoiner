<?php
/**
 * Helper.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;

use Carbon\Carbon;
use DB;
use League\HTMLToMarkdown\HtmlConverter;

class Helper
{
    public static function uniqueid($length = 13)
    {
        if (function_exists('random_bytes')) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            return base_convert(uniqid(), 16, 36);
        }

        return substr(bin2hex($bytes), 0, $length);
    }

    public static function withSymbol($value, $symbol = null)
    {
        if (blank($symbol)) {
            $symbol = 'USD';
        }
        return "<sup>$symbol</sup> $value";
    }

    public static function arrowSignal($change = 0)
    {
        $fmt = '<sup><i class="ti-arrow-%s text-%s"></i></sup> %s';
        if ($change == 0) return '';
        if ($change > 0) {
            return sprintf($fmt, 'up', 'info', $change);
        } elseif ($change < 0) {
            return sprintf($fmt, 'down', 'danger', $change);
        }
    }

    /**
     * Converts HTML to markdown
     *
     * @param string $html
     * @return null|string
     */
    public static function toMarkdown($html)
    {
        if (blank($html)) {
            return null;
        }
        $converter = new HtmlConverter();
        return $converter->convert($html);
    }

    /**
     * @param $value
     * @param null $precision
     * @return string
     */
    public static function formatPercent($value, $precision = null)
    {
        if ($precision == null) {
            $precision = setting(Consts::PRECISION_PERCENT, 2);
        }
        return number_format($value, $precision);
    }

    /**
     * @param $value
     * @param null $precision
     * @return string
     */
    public static function formatCurrency($value, $precision = null)
    {
        if ($precision == null) {
            $precision = setting(Consts::PRECISION_CURRENCY, 2);
        }
        return number_format($value, $precision);
    }

    /**
     * @param $value
     * @return string
     */
    public static function formatInteger($value)
    {
        return number_format($value);
    }

    /**
     * Splits string into lines
     *
     * @param string $s
     * @return array
     */
    public static function stringToArray($s): array
    {
        $pieces = [];
        if (!blank($s)) {
            $lines = explode("\n", $s);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!blank($line)) {
                    $pieces[] = $line;
                }
            }
        }
        return $pieces;
    }

    /**
     * Get random affiliate link
     *
     * @return string
     */
    public static function randomAffiliateLink()
    {
        $links = self::stringToArray(setting(Consts::AFFILIATE_LINKS, ''));
        if (count($links) > 0) {
            shuffle($links);
            return $links[0];
        }
        return null;
    }

    /**
     * Checks if affiliate links have been set
     *
     * @return bool
     */
    public static function hasAffiliateLinks(): bool
    {
        $links = self::stringToArray(setting(Consts::AFFILIATE_LINKS, ''));
        return count($links) > 0;
    }

    public static function formatChangeText($value)
    {
        $buf = '<span class="';
        $buf = $value > 0 ? $buf . 'change-up">' : $buf . 'change-down">';
        $buf .= self::formatPercent($value);
        $buf .= '</span>';
        return $buf;
    }

    public static function updateCurrencyRates()
    {
        $baseCurrency = 'USD'; // TODO: fetch from settings
        $api = new CurrencyRates();
        $rates = $api->latest($baseCurrency);

        foreach (array_merge($rates->getBaseRate(), $rates->getRates()) as $symbol => $rate) {
            $symbol = strtoupper($symbol);
            DB::table('currencies')->updateOrInsert(
                ['symbol' => $symbol,],
                [
                    'symbol' => $symbol,
                    'rate' => (float)$rate,
                    'last_updated' => Carbon::now()
                ]
            );
        }
    }
}