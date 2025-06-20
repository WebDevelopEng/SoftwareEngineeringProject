<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $table='ads';
    protected $fillable=['title','description','image'];
    protected $primaryKey='id';
}
