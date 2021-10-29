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

    /**
     * @param array $prependScope
     * @return array
     */
    protected function getBrowserData($prependScope = [])
    {
        $prependScope['resource'] = $this->getResource();
        return parent::getBrowserData($prependScope);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|int[]|string[]
     */
    protected function indexData($request)
    {
        $resource = $this->getResource();
        return [
            'resource' => $resource
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|int[]|string[]
     */
    protected function formData($request)
    {
        return $this->indexData($request);
    }

    /**
     * @param array $prepend
     * @return array
     */
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

        $menu = config('twill-navigation.'.$global_active_navigation);

        if(isset($menu['primary_navigation'])) {
            $primary_navigation = $menu['primary_navigation'];
            $categoriesNav = isset($primary_navigation['categories']) ? $primary_navigation['categories'] : null;

            if($categoriesNav && isset($categoriesNav['resource'])) {
                return $categoriesNav['resource'];
            }
        }
        $singularName = Str::singular($global_active_navigation);
        $modelClass = config('twill.namespace') . '\\Models\\' . Str::studly($singularName);

        if(!class_exists($modelClass)) {
            $modelClass = $this->getCapsuleByModule($global_active_navigation)['model'];
        }

        if(!class_exists($modelClass)) {
            return $global_active_navigation;
        }

        $morph = (new $modelClass)->getMorphClass();

        if($morph) {
            return $morph;
        }

        return (new $modelClass)->getTable();
    }

}
