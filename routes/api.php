<?php

use Illuminate\Http\Request;

use Aruberuto\Configurable\Helpers\ConfigurableRouteHelper;
//:NewHelperFile:

Route::group(['middleware' => 'auth:api' , 'prefix' => 'api/v1'], function() {

    ConfigurableRouteHelper::apiRoutes();
    //:NewRoutesAgregator:

});
