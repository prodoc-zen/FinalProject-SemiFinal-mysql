<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    public function studentDashboard()
    {
        $user = Auth::user();

        // Only students can access
        if ($user->role !== 'student') {
            abort(403);
        }

        // Get student's profile
        $student = StudentProfile::where('user_id', $user->id)->first();
  
        if (!$student) {
            return redirect()->route('dashboard')->with('error', 'Student profile not found.');
        }

        // Get bookings for this student, including related tutor and subject
        $bookings = Booking::with(['tutor', 'subject'])
            ->where('student_id', $student->id)
            ->get();

        // Dynamic stats
        $totalSessions = $bookings->count();

        $upcomingSessions = $bookings->whereIn('status', ['pending', 'confirmed'])->count();
        
        $activeSubjects = $bookings->isNotEmpty()
            ? $bookings->map(fn($b) => $b->subject?->name)->filter()->unique()->count()
            : 0;

        // Optionally, get next upcoming session
        $nextSession = $bookings->whereIn('status', ['pending', 'confirmed'])
            ->sortBy('scheduled_at')
            ->first();

        return view('dashboard', compact(
            'bookings',
            'totalSessions',
            'upcomingSessions',
            'activeSubjects',
            'nextSession'
        ));
    }
}
