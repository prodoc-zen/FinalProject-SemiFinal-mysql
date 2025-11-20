<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    /** @use HasFactory<\Database\Factories\StudentProfileFactory> */
    use HasFactory;

    // StudentProfile.php
    protected $fillable = ['user_id', 'phone', 'address', 'profile_picture', 'bio'];

}
