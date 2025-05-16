<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    //
    protected $fillable=['email,'username','password'];
    protected $primaryKey='id';
}
