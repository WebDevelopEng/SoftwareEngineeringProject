<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionItem extends Model
{
    protected $fillable = ['transaction_id', 'donation_id', 'quantity'];
    protected $primaryKey = 'id';

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function donation(): BelongsTo
    {
        return $this->belongsTo(donation::class);
    }
}
