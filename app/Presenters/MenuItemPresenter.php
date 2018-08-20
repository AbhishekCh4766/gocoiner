<?php
/**
 * MenuPresenter.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2018 Dr. Max Ehsan
 */

namespace App\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

class MenuItemPresenter extends BasePresenter
{
    public function menuTarget()
    {
        $page = $this->wrappedObject->page;
        if ($page != null) {
            return $page->title;
        }
        return $this->wrappedObject->link;
    }
}