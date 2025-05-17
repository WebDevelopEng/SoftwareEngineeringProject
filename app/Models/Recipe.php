<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Recipe extends Model
{
    //
    protected $fillable=[
        'Name',
        'Rating',
        'Description',
        'restaurant_id',
        'premium'
    ];
    protected $primaryKey='RecipeID';

    public function ingredients():HasMany{
        return $this->hasMany(ingredients::class,'Recipe_ID');
        }
}
