<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use App\Models\TutorSubject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\messages;


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

        $confirmed_bookings = $bookings->whereIn('status', ['confirmed']);
        $pending_bookings = $bookings->whereIn('status', ['pending']);
        $completed_bookings = $bookings->whereIn('status', ['completed']);
        $canceled_bookings = $bookings->whereIn('status', ['canceled']);

        $confirmed_bookings_count = $bookings->whereIn('status', ['confirmed'])->count();
        $pending_bookings_count = $bookings->whereIn('status', ['pending'])->count();
        $completed_bookings_count = $bookings->whereIn('status', ['completed'])->count();
        $canceled_bookings_count = $bookings->whereIn('status', ['canceled'])->count();

        $messages = messages::all();


        
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
            'messages',
        ));
    }

    public function updateProfile_student(Request $request)
    {

        $student = StudentProfile::where('user_id', Auth::id())->first();

        $studentId = $student->id;    
       
        // 1. Validate input
        try {
            $validatedData = $request->validate([
                'profileName' => 'sometimes|string|max:255',
                'profileEmail' => 'sometimes|email|max:255|unique:users,email,' . auth()->id(),
                'profilePhone' => 'sometimes|string|max:20',
                'profileAddress' => 'sometimes|string|max:255',
                'profileBio' => 'sometimes|string|max:500',
                'profileNewPassword' => 'nullable|string|min:8|confirmed',
                'profilePictureInput' => 'nullable|image|max:2048', 
            ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                dd($e->errors()); // shows exactly which fields failed
            }

        if ($request->hasFile('profilePictureInput')) {
            $file = $request->file('profilePictureInput');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename); // saves to public/images

            // Save the relative path to DB
            $student->profile_picture = 'images/' . $filename;
            $student->save();
        }


        // 3. Update User fields (name & email)
        $user = $student->user;
        if (isset($validatedData['profileName'])) $user->name = $validatedData['profileName'];
        if (isset($validatedData['profileEmail'])) $user->email = $validatedData['profileEmail'];
        $user->save();

        // 4. Update Student fields
        $student->phone = $validatedData['profilePhone'] ?? $student->phone;
        $student->address = $validatedData['profileAddress'] ?? $student->address;
        $student->bio = $validatedData['profileBio'] ?? $student->bio;
        $student->save();

        // 6. Update password if provided
        if (!empty($validatedData['profileNewPassword'])) {
            $user->password = Hash::make($validatedData['profileNewPassword']);
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
