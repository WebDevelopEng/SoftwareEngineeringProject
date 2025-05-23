<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    //
    protected $fillable=[
        'membershipDueDate',
        'membershipStart',
        'activeStatus',
        'price'
    ];
    public $timestamps = false;
}
