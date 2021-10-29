<?php


namespace App\Twill\Capsules\Categories\Repositories\Behaviors;


trait HandleCategories
{

    /**
     * @param \A17\Twill\Models\Model $object
     * @param array $fields
     * @return void
     */
    public function afterSaveHandleCategories($object, $fields)
    {
        if(isset($fields['browsers']['categories'])) {
            $object->saveCategories($fields['browsers']['categories'] ?? []);
        }
    }
}
