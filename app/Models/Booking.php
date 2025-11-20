<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(TutorProfile::class, 'tutor_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    


    
}
