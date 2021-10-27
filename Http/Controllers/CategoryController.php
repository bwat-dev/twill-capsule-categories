<?php

namespace App\Twill\Capsules\Categories\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Twill\Capsules\Menus\Models\Menu;
use Illuminate\Support\Arr;

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
        $resource = $this->getResource();
        return [
            'resource' => $resource
        ];
    }

    protected function filterScope($prepend = [])
    {
        $prepend['resource'] = $this->getResource();
        return parent::filterScope($prepend);
    }

    protected function getResource()
    {
        $url = $this->request->route()->uri;
        return Arr::first(explode('/', $url));
    }

}
