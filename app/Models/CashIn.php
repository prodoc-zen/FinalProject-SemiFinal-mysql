<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CashIn extends Model
{
    /** @use HasFactory<\Database\Factories\CashInFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
    ];

    // Relationship: a cash-in belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
