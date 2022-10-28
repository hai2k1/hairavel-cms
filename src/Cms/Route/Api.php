<?php

use Illuminate\Support\Facades\Route;

Route::get('CmsMenu/{id}', ['uses' => 'Modules\Cms\Api\Menu@list', 'desc' => 'Menu list'])->name('api.cms.menu.list');
