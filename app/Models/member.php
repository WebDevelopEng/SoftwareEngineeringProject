<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class member extends Model
{
    //
    use HasFactory;
    protected $fillable=[
        'memberId',
        'membershipDueDate',
        'membershipStart',
        'activeStatus',
        'price'
    ];
    public $timestamps = false;
}
