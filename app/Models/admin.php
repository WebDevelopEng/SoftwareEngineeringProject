<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    //
    protected $fillable=['adminUsername','adminPassword'];
    protected $primaryKey='adminId';
}
