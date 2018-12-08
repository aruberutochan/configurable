<?php

namespace Aruberuto\Configurable\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigurableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->make('Aruberuto\Configurable\Http\Controllers\ConfigurableController');
        //:bootMethodProvider:

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/../../routes/api.php';
        //:registerMethodProvider:

    }
}
