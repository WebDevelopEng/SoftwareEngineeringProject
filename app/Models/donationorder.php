<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class donationorder extends Model
{
    //
    protected $fillable=['userid','cost','donationid'];
    protected $primaryKey='id';
}
