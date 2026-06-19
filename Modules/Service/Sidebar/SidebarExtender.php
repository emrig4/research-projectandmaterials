<?php

namespace Modules\Service\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Base\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group('Services', function (Group $group) {
            $group->weight(15);
            $group->authorize(
                $this->auth->hasAccess('admin.settings.edit') || $this->auth->hasAccess('admin.translations.index')
            );
            $group->item('Services', function (Item $item) {
                $item->icon('fas fa-globe');
                $item->weight(15);
                $item->route('admin.services.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.settings.edit')
                );
            });

            $group->item('Requests', function (Item $item) {
                $item->icon('fa fa-paper-plane');
                $item->weight(15);
                $item->route('admin.servicerequests.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.settings.edit')
                );
            });

            // $group->item('Proposals', function (Item $item) {
            //     $item->icon('fa fa-money');
            //     $item->weight(15);
            //     $item->route('admin.requestproposals.index');
            //     $item->authorize(
            //         $this->auth->hasAccess('admin.settings.edit')
            //     );
            // });
        });
    }
}
