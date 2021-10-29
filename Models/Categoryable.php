<?php


namespace App\Twill\Capsules\Categories\Models;


use Illuminate\Database\Eloquent\Model;

class Categoryable extends Model
{
    protected $fillable = [
        'categoryable_id',
        'categoryable_type',
        'category_id',
        'position'
    ];
}
