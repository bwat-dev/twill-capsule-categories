<?php


namespace App\Twill\Capsules\Categories\Models\Behaviors;


use App\Twill\Capsules\Categories\Models\Category;
use App\Twill\Capsules\Categories\Models\Categoryable;
use Illuminate\Support\Collection;

trait HasCategories
{
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }
}
