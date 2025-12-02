<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class CashIn extends Model
{
    /** @use HasFactory<\Database\Factories\CashInFactory> */
    use HasFactory;

    protected $table = 'cash_in_transactions';
    protected $fillable = [
        'student_id',
        'amount',
        'payment_method',
    ];

    // Relationship: a cash-in belongs to a user
    public function student()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }


}
