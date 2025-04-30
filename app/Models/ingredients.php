<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ingredients extends Model
{
    //
    protected $fillable=["IngredientName","Quantity","RecipeID"];
    protected $primaryKey='IngredientID';
}
