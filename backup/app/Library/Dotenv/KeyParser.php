<?php
/**
 * KeyParser.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library\Dotenv;

class KeyParser
{
    private $parser;

    public function __construct($parser)
    {
        $this->parser = $parser;
    }

    public function parse($key)
    {
        $key = trim($key);
        if (StringHelper::startsWith('#', $key)) {
            return false;
        }
        if (!ctype_alnum(str_replace('_', '', $key)) || StringHelper::startsWithNumber($key)) {
            throw new ParseException(
                sprintf('Key can only contain alphanumeric and underscores and can not start with a number: %s', $key),
                $key,
                $this->parser->line_num
            );
        }
        return $key;
    }
}