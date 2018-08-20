<?php

namespace App;

use App\Presenters\MenuItemPresenter;
use App\Traits\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class MenuItem extends Model implements HasPresenter
{
    use ActiveScope;

    protected $guarded = ['id'];
    protected $casts = ['active' => 'boolean'];

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function page()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }

    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get all menu items, in a hierarchical collection.
     * Only supports 2 levels of indentation.
     */
    public static function tree()
    {
        $menu = self::orderBy('order')->get();

        if ($menu->count()) {
            foreach ($menu as $k => $menu_item) {
                $menu_item->children = collect([]);

                foreach ($menu as $i => $menu_subitem) {
                    if ($menu_subitem->parent_id == $menu_item->id) {
                        $menu_item->children->push($menu_subitem);

                        // remove the subitem for the first level
                        $menu = $menu->reject(function ($item) use ($menu_subitem) {
                            return $item->id == $menu_subitem->id;
                        });
                    }
                }
            }
        }

        return $menu;
    }

    /**
     * @return mixed|string
     */
    public function permalink()
    {
        if (!blank($this->link)) {
            return $this->link;
        }

        if ($this->page != null) {
            return route('menu.link', ['id' => $this->id, 'slug' => $this->page->slug]);
        }

        return '#';
    }

    public function menuId()
    {
        return 'menu_' . $this->id;
    }

    /**
     * Get all top level menus
     *
     * @return mixed
     */
    public static function topLevelMenus($pageSize = 10)
    {
        return self::where('parent_id', 0)->paginate($pageSize);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return MenuItemPresenter::class;
    }
}
