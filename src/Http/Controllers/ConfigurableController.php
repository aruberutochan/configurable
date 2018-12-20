<?php
namespace Aruberuto\Configurable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aruberuto\Configurable\Http\Resources\ConfigResource;
use Aruberuto\Configurable\Helpers\EloquentStructureHelper;

/**
 * Controller to make http request and obtain the configuration
 */
class ConfigurableController extends Controller {

    public function getConfig($entity, Request $request) {
        $config = config('entities.' . $entity, null);
        if($config) {
            $status = 200;
        } else {
            $status = 400;
        }
        return (new ConfigResource(collect($config)))->response()->setStatusCode($status);
    }

    public function getStructure($entity, Request $request) {
        $class = config('entities.' . $entity . '.entity.class', '' );
        $structure = $class ? EloquentStructureHelper::getStructure($class) : [];
         if($structure) {
            $status = 200;
        } else {
            $status = 400;
        }
        return (new ConfigResource(collect($structure)))->response()->setStatusCode($status);
    }

}
