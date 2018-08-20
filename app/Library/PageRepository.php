<?php
/**
 * PageRepository.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Library;

use App\Page;

class PageRepository
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