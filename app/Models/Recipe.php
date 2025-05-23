<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Recipe extends Model
{
    //
    protected $fillable=[
        'Name',
        'image',
        'Description',
        'restaurant_id',
        'premium',
        'Ingredients',
        'category'
    ];
    protected $primaryKey='RecipeID';

}
