<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class admin extends Model
{
    //
    use HasFactory;
    protected $fillable=['username','password','email'];
    protected $primaryKey='id';
}
