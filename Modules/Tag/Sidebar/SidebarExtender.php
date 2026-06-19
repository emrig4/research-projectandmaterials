<?php

namespace Modules\Tag\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group('Tags', function (Group $group) {
            $group->weight(15);
            $group->authorize(
                $this->auth->hasAccess('admin.settings.edit') || $this->auth->hasAccess('admin.translations.index')
            );
            $group->item('Tags', function (Item $item) {
                $item->icon('fa fa-book');
                $item->weight(15);
                $item->route('admin.tags.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.settings.edit')
                );
            });
        });
    }
}
