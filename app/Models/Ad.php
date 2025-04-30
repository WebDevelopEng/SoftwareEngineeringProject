<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    
    protected $fillable=['url','description'];
    protected $primaryKey=['id'];
}
