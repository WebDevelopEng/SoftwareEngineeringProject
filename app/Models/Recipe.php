<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
