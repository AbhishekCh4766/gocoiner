<?php

namespace App;

use App\Presenters\NewsPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class CoinCalender extends Model implements HasPresenter
{
    protected $guarded = ['id'];
    protected $dates = ['pubDate', 'updated_at'];

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return NewsPresenter::class;
    }
}
