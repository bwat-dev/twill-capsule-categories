# Exemple

```php
// in a route file
Route::group([
    'prefix'    => 'pages',
    'namespace' => '\App\Twill\Capsules\Categories\Http\Controllers'
], function () {
    Route::module('categories');
});

Route::module('pages');
```

## In twill-navigation
```php
    'pages' => [
        'title' => 'Pages',
        'module' => true,
        'primary_navigation' => [
            'pages' => [
                'title' => 'Pages',
                'raw' => true,
                'route' => '/pages',
            ],
            'categories' => [
                'title' => 'Catégories',
                'module' => true,
                'resource' => 'pages' //optional
            ]
        ]
    ],
```
## Model

import HasCategories trait in your model :
```php
use App\Twill\Capsules\Categories\Models\Behaviors\HasCategories;

class Page extends Model implements Sortable
{
    use HasCategories;
...
```

## Repository

import HandleCategories trait in your Repository :
```php
<?php

namespace App\Twill\Capsules\Pages\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Twill\Capsules\Categories\Repositories\Behaviors\HandleCategories;
use App\Twill\Capsules\Pages\Models\Page;

class PageRepository extends ModuleRepository
{
    use HandleCategories;

    protected $browsers = [
        'categories' => [
            'routePrefix' => 'pages'
        ]
    ];

    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}
```
