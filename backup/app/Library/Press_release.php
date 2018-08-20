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

class Press_release
{
    

   public static function blogPostsCount()
    {
        try {
            return cache()->remember('blog.count',
                Consts::CACHE_DURATION_SMALL,
                function () {
                    return Page::active()->post()->count();
                });
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

     public static function flushCache()
    {

        
        try {
            cache()->forget('blog.count');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

   
}