<?php
/**
 * NewsRepository.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;


use Carbon\Carbon;
use DB;
use Log;

class EventRepository
{
    public static function needsUpdate()
    {
        return  DB::table('coincalendar')->select('*')->get();
             

    }



   
}