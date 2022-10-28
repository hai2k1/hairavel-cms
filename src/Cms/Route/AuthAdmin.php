<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cms',
    'auth_app' => 'content management'
], function () {

    Route::group([
        'auth_group' => 'menu management'
    ], function () {
        Route::manage(\Modules\Cms\Admin\Menu::class)->only(['index', 'data', 'page', 'save', 'del'])->make();
    });
    Route::group([
        'auth_group' => 'Menu content management'
    ], function () {
        Route::manage(\Modules\Cms\Admin\MenuItems::class)->only(['index', 'data', 'page', 'save', 'del', 'sort'])->prefix ('menuItems-{menu}')->make();
    });

    Route::group([
        'auth_group' => 'custom page'
    ], function () {
        Route::manage(\Modules\Cms\Admin\Page::class)->only(['index', 'data', 'page', 'save', 'del'])->make();
    });

    Route::group([
        'auth_tags' => 'content tag'
    ], function () {
        Route::get('tags', ['uses' => 'Modules\Cms\Admin\Tags@index', 'desc' => 'list'])->name('admin.cms.tags');
        Route::get('tags/ajax', ['uses' => 'Modules\Cms\Admin\Tags@ajax', 'desc' => 'ajax data'])->name('admin.cms.tags.ajax');
        Route::post('tags/del/{id?}', ['uses' => 'Modules\Cms\Admin\Tags@del', 'desc' => 'delete'])->name('admin.cms.tags.del');
        Route::get('tags/empty', ['uses' => 'Modules\Cms\Admin\Tags@empty', 'desc' => 'cleanup'])->name('admin.cms.tags.empty');
    });
    Route::group([
        'auth_group' => 'template tag'
    ], function () {
        Route::manage(\Modules\Cms\Admin\Mark::class)->make();
    });
    // Generate Route Make
});
