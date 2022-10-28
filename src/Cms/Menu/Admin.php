<?php

use \Hairavel\Core\Facades\Menu;

Menu::push('tools', function () {
    Menu::group([
        'name' => 'site tools',
        'order' => 0,
    ], function () {
        Menu::link('Menu management', 'admin.cms.menu');
        Menu::link('custom page', 'admin.cms.page');
        Menu::link('Content tags', 'admin.cms.tags');
        Menu::link('template mark', 'admin.cms.mark');
    });

    Menu::group([
        'name' => 'site menu',
        'order' => 1,
    ], function () {
        $model = \Modules\Cms\Model\CmsMenu::get();
        $model->map(function ($item) {
            Menu::link($item['name'], 'admin.cms.menuItems', ['menu' => $item['menu_id']]);
        });
    });

});
