<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table='ads';
    protected $fillable=['title','description','image'];
    protected $primaryKey='id';
}
