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


