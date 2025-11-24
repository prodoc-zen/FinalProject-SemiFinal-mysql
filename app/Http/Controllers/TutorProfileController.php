<?php

namespace App\Http\Controllers;

use App\Models\TutorSubject;
use App\Models\Booking;
use App\Models\TutorProfile;
use App\Models\StudentProfile;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class TutorProfileController extends Controller
{
    public function tutorDashboard()
    {
        $user = Auth::user();
        $tutors = TutorSubject::with(['tutor'])->get();

        // Only tutors can access
        if ($user->role !== 'tutor') {
            abort(403);
        }

        // Get tutor's profile
        $tutor = TutorProfile::where('user_id', $user->id)->first();
  
        if (!$tutor) {
            return redirect()->route('login')->with('error', 'Tutor profile not found.');
        }

        $tutorId = $tutor->id; // or whatever tutor ID you have

        $subjectIds = TutorSubject::where('tutor_id', $tutorId)
            ->pluck('subject_id')   
            ->toArray();  

        $subjects = Subject::whereIn('id', $subjectIds)
            ->pluck('name') 
            ->toArray();

        // Get bookings for this tutor, including related tutor and subject
        $bookings = Booking::with(['tutor', 'subject'])
            ->where('tutor_id', $tutor->id)
            ->get();

        // Dynamic stats
        $totalSessions = $bookings->count();

        

        $confirmed_bookings = $bookings->whereIn('status', ['confirmed'])->values();
        $pending_bookings = $bookings->whereIn('status', ['pending'])->values();
        $completed_bookings = $bookings->whereIn('status', ['completed'])->values();
        $canceled_bookings = $bookings->whereIn('status', ['canceled'])->values();

        $upcomingSessions = $bookings->whereIn('status', ['pending', 'confirmed'])->count();
        
        $confirmed_bookings_count = $bookings->whereIn('status', ['confirmed'])->count();
        $pending_bookings_count = $bookings->whereIn('status', ['pending'])->count();
        $completed_bookings_count = $bookings->whereIn('status', ['completed'])->count();
        $canceled_bookings_count = $bookings->whereIn('status', ['canceled'])->count();


        
        $activeSubjects = $bookings->isNotEmpty()
            ? $bookings->map(fn($b) => $b->subject?->name)->filter()->unique()->count()
            : 0;

        // Next session details
        $nextSession = $bookings->whereIn('status', ['confirmed'])
            ->sortBy('scheduled_at')
            ->first();


        return view('dashboard-tutor', compact(
            'bookings',
            'totalSessions',
            'upcomingSessions',
            'activeSubjects',
            'nextSession',
            'tutors',
            'user',
            'confirmed_bookings',
            'pending_bookings',
            'completed_bookings',
            'canceled_bookings',
            'tutor',
            'confirmed_bookings_count',
            'pending_bookings_count',
            'completed_bookings_count',
            'canceled_bookings_count',
            'subjects'
        ));
    }

}
