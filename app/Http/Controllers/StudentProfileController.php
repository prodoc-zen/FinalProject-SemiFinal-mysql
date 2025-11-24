<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use App\Models\TutorSubject;

class StudentProfileController extends Controller
{
    public function studentDashboard()
    {
        $user = Auth::user();
        $tutors = TutorSubject::with(['tutor'])->get();

        // Only students can access
        if ($user->role !== 'student') {
            abort(403);
        }

        // Get student's profile
        $student = StudentProfile::where('user_id', $user->id)->first();
  
        

        // Get bookings for this student, including related tutor and subject
        $bookings = Booking::with(['tutor', 'subject'])
            ->where('student_id', $student->id)
            ->get();

        // Dynamic stats
        $totalSessions = $bookings->count();

        $upcomingSessions = $bookings->whereIn('status', ['pending', 'confirmed'])->count();

        $confirmed_bookings = $bookings->whereIn('status', ['confirmed'])->values();
        $pending_bookings = $bookings->whereIn('status', ['pending'])->values();
        $completed_bookings = $bookings->whereIn('status', ['completed'])->values();
        $canceled_bookings = $bookings->whereIn('status', ['canceled'])->values();

        $confirmed_bookings_count = $bookings->whereIn('status', ['confirmed'])->count();
        $pending_bookings_count = $bookings->whereIn('status', ['pending'])->count();
        $completed_bookings_count = $bookings->whereIn('status', ['completed'])->count();
        $canceled_bookings_count = $bookings->whereIn('status', ['canceled'])->count();

        
        $activeSubjects = $bookings->isNotEmpty()
            ? $bookings->map(fn($b) => $b->subject?->name)->filter()->unique()->count()
            : 0;

        // Next session details
        $nextSession = $bookings->whereIn('status', ['pending', 'confirmed'])
            ->sortBy('scheduled_at')
            ->first();

        return view('dashboard', compact(
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
            'student',
            'confirmed_bookings_count',
            'pending_bookings_count',
            'completed_bookings_count',
            'canceled_bookings_count',
        ));
    }
}
