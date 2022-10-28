<?php

namespace Modules\Cms\Providers;

use Modules\Cms\Middleware\Web;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // register theme configuration
        $this->mergeConfigFrom(__DIR__ . '/../Config/Theme.php', 'theme');


        // register middleware
        $kernel = $this->app->make(Kernel::class);
        $kernel->appendMiddlewareToGroup('web', Web::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        \Hairavel\Core\Util\Blade::make('marker', \Modules\Cms\Service\Blade::class, 'mark');
        \Hairavel\Core\Util\Blade::loopMake('menu', \Modules\Cms\Service\Blade::class, 'menu');
        \Hairavel\Core\Util\Blade::loopMake('form', \Modules\Cms\Service\Blade::class, 'form');

        // register database directory
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../../../database/migrations'));


        $this->publishes([
            __DIR__.'/../../../theme' => public_path('themes'),
        ], 'haibase/hairavel-cms');
    }
}
