<?php
/**
 * MenuGenerator.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Services;

use App\MenuItem;
use Menu as LavaryMenu;

class MenuGenerator
{
    public static function topLevelMenus()
    {
        return MenuItem::active()
            ->where('parent_id', 0)
            ->orderBy('order')
            ->get();
    }

    public static function generate(MenuItem $parent)
    {
        $menus = MenuItem::active()
            ->where('parent_id', $parent->id)
            ->with('page')
            ->orderBy('order')
            ->get();

        LavaryMenu::make($parent->menuId(),
            function ($builder) use ($menus) {
                foreach ($menus as $item) {
                    $builder->add($item->name, ['url' => $item->permalink()]);
                }
            });
    }
}