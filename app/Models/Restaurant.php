<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $fillable =['restaurantEmail','password','restaurantName','balance','location','image'];
    protected $primaryKey = 'id';
}
