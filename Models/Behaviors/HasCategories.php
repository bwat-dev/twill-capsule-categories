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
    public function saveCategories($items)
    {

        Collection::make($items)->each(function ($values)  {
            Categoryable::where([
                'category_id' => $values['id'],
                'categoryable_id' => $this->id,
                'categoryable_type' => $this->getMorphClass(),
            ])->delete();
        });

        Collection::make($items)->each(function ($values)  {
            Categoryable::create([
                'category_id' => $values['id'],
                'categoryable_id' => $this->id,
                'categoryable_type' => $this->getMorphClass(),
            ]);
        });
    }
}
