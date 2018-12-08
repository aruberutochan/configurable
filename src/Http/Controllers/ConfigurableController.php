<?php
namespace Aruberuto\Configurable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aruberuto\Configurable\Http\Resources\ConfigResource;
use Aruberuto\Configurable\Helpers\EloquentStructureHelper;

class ConfigurableController extends Controller {

    public function getConfig($entity, Request $request) {
        // $config = config('entities.' . $entity, []);
        $config = EloquentStructureHelper::getConfigDefault('\Aruberuto\Blog\Entities\Post');
        return new ConfigResource(collect($config));
    }

    public function getStructure($entity, Request $request) {
        $namespace = config('entities.' . $entity . '.entity.namespace', '' );
        $class =  EloquentStructureHelper::getEntityClass($entity, $namespace);
        $structure = EloquentStructureHelper::getStructure($class);
        return new ConfigResource(collect($structure));
    }

}
