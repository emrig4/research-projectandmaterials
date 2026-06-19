<?php

namespace Modules\Testimonial\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group('Testimonials', function (Group $group) {
            $group->weight(60);
            $group->authorize(
                   $this->auth->hasAccess('admin.reviews.index')
            );
            $group->item('List', function (Item $item) {
                $item->weight(20);
                $item->icon('fas fa-list');
                $item->route('admin.testimonials.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.reviews.index')
                );
            });

            $group->item('Create', function (Item $item) {
                $item->weight(25);
                $item->icon('fas fa-file');
                $item->route('admin.testimonials.create');
                $item->authorize(
                    $this->auth->hasAccess('admin.reviews.index')
                );
            });
        });
    }
}
