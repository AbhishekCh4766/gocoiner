<?php
/**
 * FrontendViewComposer.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\ViewComposers;

use App\Services\MenuGenerator;
use Illuminate\View\View;

class SidebarViewComposer
{
    /**
     * Bind data with view
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $this->generateMenus($view);
    }

    /**
     * Generates menu items
     *
     * @param View $view
     */
    private function generateMenus(View $view)
    {
        $items = MenuGenerator::topLevelMenus();
        $menus = [];
        foreach ($items as $m) {
            if ($m->hasChildren()) {
                MenuGenerator::generate($m);
            }
            $menus[$m->menuId()] = ['title' => $m->name, 'url' => $m->permalink(), 'has_children' => $m->hasChildren()];
        }
        $view->with('custom_menus', $menus);
    }

}