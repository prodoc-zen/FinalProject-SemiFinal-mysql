<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TutorProfile extends Model
{
    /** @use HasFactory<\Database\Factories\TutorProfileFactory> */
    use HasFactory;

    // TutorProfile.php
    protected $fillable = ['user_id', 'phone', 'address', 'profile_picture', 'bio', 'rating', 'balance', 'hourly_rate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // user_id column must exist
    }






}
