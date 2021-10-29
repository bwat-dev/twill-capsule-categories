<?php


namespace App\Twill\Capsules\Categories\Models\Behaviors;


use A17\Twill\Models\RelatedItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasCategories
{
    public function saveRelated($items)
    {
        RelatedItem::where([
            'subject_id' => $this->getKey(),
            'subject_type' => $this->getMorphClass(),
        ])->delete();

        $position = 1;

        Collection::make($items)->map(function ($item) {
            return Arr::only($item, ['endpointType', 'id']);
        })->each(function ($values) use ($browser_name, &$position) {
            RelatedItem::create([
                'subject_id' => $this->getKey(),
                'subject_type' => $this->getMorphClass(),
                'related_id' => $values['id'],
                'related_type' => $values['endpointType'],
                'browser_name' => $browser_name,
                'position' => $position,
            ]);
            $position++;
        });
    }
}
