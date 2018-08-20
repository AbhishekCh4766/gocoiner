<?php
/**
 * ValueParser.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library\Dotenv;

class ValueParser
{
    /**
     * The regex to get the content between double quote (") strings, ignoring escaped quotes.
     * Unescaped: "(?:[^"\\]*(?:\\.)?)*"
     *
     * @var string REGEX_QUOTE_DOUBLE_STRING
     */
    const REGEX_QUOTE_DOUBLE_STRING = '"(?:[^\"\\\\]*(?:\\\\.)?)*\"';
    /**
     * The regex to get the content between single quote (') strings, ignoring escaped quotes
     * Unescaped: '(?:[^'\\]*(?:\\.)?)*'
     *
     * @var string REGEX_QUOTE_SINGLE_STRING
     */
    const REGEX_QUOTE_SINGLE_STRING = "'(?:[^'\\\\]*(?:\\\\.)?)*'";

    private static $value_types = ['string', 'bool', 'number', 'null',];

    private static $character_map = ["\\n" => "\n", "\\\"" => '"', '\\\'' => "'", '\\t' => "\t"];
    private $parser;

    public function __construct($parser)
    {
        $this->parser = $parser;
    }

    public function parse($value)
    {
        $value = trim($value);
        if (StringHelper::startsWith('#', $value)) {
            return null;
        }
        return $this->parseValue($value);
    }

    private function parseValue($value)
    {
        foreach (self::$value_types as $type) {
            $parsed_value = $value;
            if ($type !== 'string') {
                $parsed_value = StringHelper::stripComments($value);
            }
            list($is_function, $parse_function) = $this->fetchFunctionNames($type);
            if (StringHelper::$is_function($parsed_value)) {
                return $this->$parse_function($parsed_value);
            }
        }
        return (isset($parsed_value)) ? $this->parseUnquotedString($parsed_value) : $value;
    }

    private function fetchFunctionNames($type)
    {
        $type = ucfirst($type);
        return ['is' . $type, 'parse' . $type];
    }

    private function parseString($value)
    {
        $regex = self::REGEX_QUOTE_DOUBLE_STRING;
        $symbol = '"';
        if (StringHelper::startsWith('\'', $value)) {
            $regex = self::REGEX_QUOTE_SINGLE_STRING;
            $symbol = "'";
        }
        $matches = $this->fetchStringMatches($value, $regex, $symbol);
        $value = trim($matches[0], $symbol);
        $value = strtr($value, self::$character_map);
        return $value;
    }

    private function fetchStringMatches($value, $regex, $symbol)
    {
        if (!preg_match('/' . $regex . '/', $value, $matches)) {
            throw new ParseException(
                sprintf('Missing end %s quote', $symbol),
                $value,
                $this->parser->line_num
            );
        }
        return $matches;
    }

    private function parseNull($value)
    {
        return (null === $value || $value === 'null') ? null : false;
    }

    private function parseUnquotedString($value)
    {
        return $value === '' ? null : $value;
    }

    private function parseBool($value)
    {
        $value = strtolower($value);
        return $value === "true" || $value === "yes";
    }

    private function parseNumber($value)
    {
        if (strpos($value, '.') !== false) {
            return (float)$value;
        }
        return (int)$value;
    }
}