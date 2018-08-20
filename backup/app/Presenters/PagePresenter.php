<?php
/**
 * PagePresenter.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Presenters;

use App\Library\Consts;
use App\Library\Helper;
use Carbon\Carbon;
use McCool\LaravelAutoPresenter\BasePresenter;

class PagePresenter extends BasePresenter
{
    public function last_updated()
    {
        $date = $this->wrappedObject->updated_at ?? $this->wrappedObject->created_at;
        if ($date == null || is_int($date)) {
            $date = Carbon::createFromTimestamp($this->wrappedObject->updated_at ?? $this->wrappedObject->created_at);
        }

        return $date->toDateTimeString();
    }

    public function last_updated_human()
    {
        $date = $this->wrappedObject->updated_at ?? $this->wrappedObject->created_at;
        if ($date == null || is_int($date)) {
            $date = Carbon::createFromTimestamp($this->wrappedObject->updated_at ?? $this->wrappedObject->created_at);
        }

        return $date->diffForHumans();
    }

    public function type()
    {
        return $this->wrappedObject->page_type == Consts::PAGE_TYPE_POST ? 'Post' : 'Custom Page';
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function excerpt($limit = 200)
    {
        if ($this->wrappedObject->page_type == Consts::PAGE_TYPE_POST) {
            return cache()->remember('page_' . $this->wrappedObject->id,
                Consts::CACHE_DURATION_SMALL,
                function () use ($limit) {
                    $content = Helper::toMarkdown($this->wrappedObject->content);
                    return str_limit($content, $limit);
                });
        }
        return '';
    }
}