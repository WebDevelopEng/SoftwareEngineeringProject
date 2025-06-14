<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class donation extends Model
{
    use HasFactory;
    //
    protected $fillable =['restaurant_id','name','price','description','image','count'];
    protected $primaryKey='id';

    public function Restaurant(): BelongsTo
    {
        
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }
}
