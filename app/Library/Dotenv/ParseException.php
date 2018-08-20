<?php
/**
 * ParseException.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library\Dotenv;

class ParseException extends \Exception
{
    public function __construct($message, $line = null, $line_num = null)
    {
        $message = $this->createMessage($message, $line, $line_num);
        parent::__construct($message);
    }

    private function createMessage($message, $line, $line_num)
    {
        if (null !== $line) {
            $message .= sprintf(' near %s', $line);
        }
        if (null !== $line_num) {
            $message .= sprintf(' at line %d', $line_num);
        }
        return $message;
    }
}