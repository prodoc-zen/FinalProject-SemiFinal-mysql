<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorSubject extends Model
{
    /** @use HasFactory<\Database\Factories\TutorSubjectFactory> */
    use HasFactory;
    

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
