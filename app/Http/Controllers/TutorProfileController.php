<?php

namespace App\Http\Controllers;
use App\Models\TutorSubject;


use Illuminate\Http\Request;

class TutorProfileController extends Controller
{
    public function browseTutors()
    {
        $tutors = TutorSubject::with(['tutor'])->get();

        return view('dashboard', compact('tutors'));
    }

}
