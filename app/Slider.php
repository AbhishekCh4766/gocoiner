<?php

namespace App;

use App\Library\Consts;
use App\Presenters\PagePresenter;
use App\Traits\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Slider extends Model implements HasPresenter
{
    use HasSlug, ActiveScope;

    protected $guarded = ['id'];
    protected $table = 'slider';
    protected $casts = ['active' => 'boolean'];

    public function isActive()
    {
        return (bool)$this->active;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->doNotGenerateSlugsOnUpdate()
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs()
            ->slugsShouldBeNoLongerThan(180);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function isCustomPage()
    {
        return $this->page_type == Consts::PAGE_TYPE_CUSTOM;
    }

    public function getPresenterClass()
    {
        return PagePresenter::class;
    }

    public function scopePost($q)
    {
        return $q->where('page_type', Consts::PAGE_TYPE_POST);
    }
}
