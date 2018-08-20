<?php
/**
 * env_reader.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library\Dotenv;

class EnvReader
{
    private $_key_parser;
    public $line_num;
    public $_lines = [];
    private $_value_parser;

    public function __construct($content)
    {
        $this->_key_parser = new KeyParser($this);
        $this->_value_parser = new ValueParser($this);
        $this->doParse($content);
    }

    public static function parse($content)
    {
        $parser = new EnvReader($content);
        return $parser->getContent();
    }

    private function doParse($content)
    {
        $raw_lines = array_filter($this->makeLines($content), 'strlen');
        if (empty($raw_lines)) {
            return [];
        }
        return $this->parseContent($raw_lines);
    }

    private function makeLines($content)
    {
        return explode("\n", str_replace(["\r\n", "\n\r", "\r"], "\n", $content));
    }

    private function parseContent(array $raw_lines)
    {
        $this->_lines = array();
        $this->line_num = 0;
        foreach ($raw_lines as $raw_line) {
            $this->line_num++;
            if (StringHelper::startsWith('#', $raw_line) || !$raw_line) {
                continue;
            }
            $this->parseLine($raw_line);
        }
        return $this->_lines;
    }

    private function parseLine($raw_line)
    {
        list($key, $value) = $this->parseKeyValue($raw_line);
        $key = $this->_key_parser->parse($key);
        if (!is_string($key)) {
            return;
        }
        $this->_lines[$key] = $this->_value_parser->parse($value);
    }

    private function parseKeyValue($raw_line)
    {
        $key_value = explode("=", $raw_line, 2);
        if (count($key_value) !== 2) {
            throw new ParseException(
                'You must have a key = value',
                $raw_line,
                $this->line_num
            );
        }
        return $key_value;
    }

    public function getContent()
    {
        return $this->_lines;
    }
}