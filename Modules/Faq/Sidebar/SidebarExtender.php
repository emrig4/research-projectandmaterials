<?php

namespace Modules\Faq\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group('FAQ', function (Group $group) {
            $group->weight(55);
            $group->authorize(
                $this->auth->hasAccess('admin.settings.edit') || $this->auth->hasAccess('admin.translations.index')
            );
            $group->item('Faqs', function (Item $item) {
                $item->icon('fa fa-question-circle');
                $item->weight(15);
                $item->route('faqs.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.settings.edit')
                );
            });

            $group->item('Categories', function (Item $item) {
                $item->icon('fa fa-question');
                $item->weight(15);
                $item->route('faqs.categories.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.settings.edit')
                );
            });
        });
    }
}
