<?php

use Illuminate\Support\Facades\Route;

// The default route of the website home page (can be customized to override)
Route::get('/', [\Modules\Cms\Web\Index::class, 'index'])->middleware('web')->name('web.index');

Route::group([
    'app' => 'content management'
], function () {
    Route::group([
        'group' => 'custom page'
    ], function () {
        Route::get('page/{id}', ['uses' => 'Modules\Cms\Web\Pages@index', 'desc' => 'page'])->name('web.pages' );
    });


    Route::group([
        'prefix' => 'form',
        'group' => 'custom form'
    ], function () {
        Route::get('list/{id}', ['uses' => 'Modules\Cms\Web\Form@index', 'desc' => 'list'])->name('web.form.list');
        Route::get('info/{id}', ['uses' => 'Modules\Cms\Web\Form@info', 'desc' => 'details'])->name('web.form.info');
        Route::post('push/{id}', ['uses' => 'Modules\Cms\Web\Form@push', 'desc' => 'post'])->name('web.form.push');
    });

});
