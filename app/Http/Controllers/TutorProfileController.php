<?php

namespace App\Http\Controllers;

use App\Models\TutorSubject;
use App\Models\Booking;
use App\Models\TutorProfile;
use App\Models\StudentProfile;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



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

    public function updateProfile_tutor(Request $request)
    {
        $tutor = TutorProfile::where('user_id', Auth::id())->first();
       $tutorSubjects = TutorSubject::with('subject')
        ->where('tutor_id', $tutor->id)
        ->get();

        $tutorId = $tutor->id;

        $subjects = Subject::all()->pluck('name');

        $subjectIds = $tutorSubjects->pluck('subject_id');
        $subjectsIhave = $tutorSubjects->pluck('subject.name');
 
        

        

                
       
        if ($request->has('subjectsTeaching_profile')) {
            $request->merge([
                'subjectsTeaching_profile' => json_decode($request->input('subjectsTeaching_profile'), true)
            ]);
        }
        // 1. Validate input
        try {
            $validatedData = $request->validate([
                'profileName' => 'sometimes|string|max:255',
                'profileEmail' => 'sometimes|email|max:255|unique:users,email,' . auth()->id(),
                'profilePhone' => 'sometimes|string|max:20',
                'profileAddress' => 'sometimes|string|max:255',
                'profileBio' => 'sometimes|string|max:500',
                'profileRate' => 'sometimes|numeric|min:10',
                'subjectsTeaching_profile' => 'sometimes|array',
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
            $tutor->profile_picture = 'images/' . $filename;
            $tutor->save();
        }


        // 3. Update User fields (name & email)
        $user = $tutor->user;
        if (isset($validatedData['profileName'])) $user->name = $validatedData['profileName'];
        if (isset($validatedData['profileEmail'])) $user->email = $validatedData['profileEmail'];
        $user->save();

        // 4. Update Tutor fields
        $tutor->phone = $validatedData['profilePhone'] ?? $tutor->phone;
        $tutor->address = $validatedData['profileAddress'] ?? $tutor->address;
        $tutor->bio = $validatedData['profileBio'] ?? $tutor->bio;
        $tutor->hourly_rate = $validatedData['profileRate'] ?? $tutor->hourly_rate;
        $tutor->save();

        $onlyInArray1 = array_diff($validatedData['subjectsTeaching_profile'], $subjectsIhave->toArray());
        $onlyInArray2 = array_diff($subjectsIhave->toArray(), $validatedData['subjectsTeaching_profile']);

        $subjectsToAddIds = Subject::whereIn('name', $onlyInArray1)->pluck('id')->toArray();
        $subjectsToRemoveIds = Subject::whereIn('name', $onlyInArray2)->pluck('id')->toArray();

        

        
       foreach ($subjectsToAddIds as $subjectId) {
            // Check if this combination already exists
            $exists = TutorSubject::where('tutor_id', $tutorId)
                        ->where('subject_id', $subjectId)
                        ->exists();

            if (!$exists) {
                TutorSubject::create([
                    'tutor_id' => $tutorId,
                    'subject_id' => $subjectId,
                ]);
            }
        }

        // ------------------ REMOVE SUBJECTS ------------------
        TutorSubject::where('tutor_id', $tutorId)
            ->whereIn('subject_id', $subjectsToRemoveIds)
            ->delete();




        // 6. Update password if provided
        if (!empty($validatedData['profileNewPassword'])) {
            $user->password = Hash::make($validatedData['profileNewPassword']);
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
