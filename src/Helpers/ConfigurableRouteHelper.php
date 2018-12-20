<?php

namespace Aruberuto\Configurable\Helpers;

use Illuminate\Support\Facades\Route;
use Aruberuto\Configurable\Http\Controllers\ConfigurableController;

class ConfigurableRouteHelper {

    public static function  apiRoutes() {

        Route::get('config/{entity}', ConfigurableController::class . '@getConfig');
        Route::get('structure/{entity}', ConfigurableController::class . '@getStructure');


    }

}
