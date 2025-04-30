<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $fillable =['restaurantUsername','restaurantPassword','restaurantName','balance'];
    protected $primaryKey = 'restaurantId';
}
