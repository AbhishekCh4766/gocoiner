<?php
/**
 * JobQueueRepository.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library;

use App\HistoryJobQueue;
use DB;

class JobQueueRepository
{
    private static function sanitizeSymbol($symbol)
    {
        return strtoupper(trim($symbol));
    }

    public static function queuedSymbols()
    {
        return DB::table('history_job_queues')->select('symbol')->distinct()->get();
    }

    public static function flush()
    {
        DB::table('history_job_queues')->delete();
    }

    public static function queueJob($symbol)
    {
        HistoryJobQueue::create(['symbol' => self::sanitizeSymbol($symbol)]);
    }

    public static function removeJob($symbol)
    {
        DB::table('history_job_queues')
            ->where('symbol', self::sanitizeSymbol($symbol))
            ->delete();
    }
}