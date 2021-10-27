#Exemple

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

```php
// in twill-navigation.php
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
                'module' => true
            ]
        ]
    ],
```
