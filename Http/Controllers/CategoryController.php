<?php

namespace App\Twill\Capsules\Categories\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Twill\Capsules\Menus\Models\Menu;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CategoryController extends ModuleController
{
    protected $moduleName = 'categories';

    protected function getBrowserData($prependScope = [])
    {
        $prependScope['resource'] = $this->getResource();
        return parent::getBrowserData($prependScope);
    }

    protected function indexData($request)
    {
        $resource = $this->getResource();
        return [
            'resource' => $resource
        ];
    }

    protected function formData($request)
    {
        return $this->indexData($request);
    }

    protected function filterScope($prepend = [])
    {
        $prepend['resource'] = $this->getResource();
        return parent::filterScope($prepend);
    }

    /**
     * Resolve resource
     * @return int|mixed|string
     */
    protected function getResource()
    {
        $routeName = $this->request->route()->getName();

        $activeMenus = explode('.', $routeName);

        //starts at 1 because first segment of all back route name is 'admin'
        $global_active_navigation = $activeMenus[1];

        $singularName = Str::singular($global_active_navigation);
        $modelClass = config('twill.namespace') . '\\Models\\' . Str::studly($singularName);

        if(!class_exists($modelClass)) {
            $modelClass = $this->getCapsuleByModule($global_active_navigation)['model'];
        }

        if(!class_exists($modelClass)) {
            return $global_active_navigation;
        }

        $morph = Arr::where(Relation::$morphMap, function ($value) use($modelClass) {
            return $value == $modelClass;
        });

        $morph = array_key_first($morph);

        if($morph) {
            return $morph;
        }

        return (new $modelClass)->getTable();
    }

}
