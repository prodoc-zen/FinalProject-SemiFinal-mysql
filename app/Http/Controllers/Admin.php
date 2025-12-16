<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\Booking;
use App\Models\Subject;
use App\Models\StudentProfile;
use App\Models\TutorSubject;
use App\Models\User;


use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    //
    public function adminDashboard()
    {
        $user = Auth::user();

        $users = User::all();
        $users_count = User::all()->count();
        $tutors = TutorProfile::with(['user'])->get();
        $students = StudentProfile::with(['user'])->get();

        $tutors_count = TutorProfile::all()->count();
        $students_count = StudentProfile::all()->count();

        $tutors_subjects = TutorSubject::with(['tutor', 'subject'])->get();

        $bookings = Booking::with(['tutor', 'student', 'subject'])->get();
        // Only admin can access
        if ($user->role !== 'admin') {
            abort(403);
        }



        return view('dashboard-admin', 
        compact(
            'tutors', 
            'students',
            'tutors_count', 
            'students_count', 
            'tutors_subjects', 
            'bookings',
            'users',
            'users_count',
        ));
    }

    //admin - delete user
    public function deleteUser(Request $request)
    {
        $userId = $request->input('userIdToDelete');
        User::where('id', $userId)->delete();


        return redirect()->route('admin.dashboard')->with('success', 'Deletion successful!');
    }

    public function deleteBooking(Request $request)
    {
        $bookingId = $request->input('bookingIdToDelete');
        Booking::where('id', $bookingId)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Deletion successful!');
    }

    public function deleteStudent(Request $request)
    {
        $studentId = $request->input('studentIdToDelete');
        $userId = StudentProfile::where('id', $studentId)->value('user_id');
        User::where('id', $userId)->delete();
        StudentProfile::where('id', $studentId)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Deletion successful!');
    }

    public function deleteTutor(Request $request)
    {
        $tutorId = $request->input('tutorIdToDelete');
        $userId = TutorProfile::where('id', $tutorId)->value('user_id');
        User::where('id', $userId)->delete();
        TutorProfile::where('id', $tutorId)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Deletion successful!');
    }

    public function editTutor(Request $request)
    {
        $request->validate([
            'editId_tutor' => 'required|integer|exists:tutor_profiles,id',
            'editName_tutor' => 'required|string|max:255',
            'editEmail_tutor' => 'required|email|max:255|unique:users,email,' . $request->input('editId_tutor'),
            'editBalance_tutor' => 'required|numeric|min:0',
            ],[
                'editEmail_tutor.unique' => 'The email has already been taken by another user.',
                'editBalance_tutor.min' => 'The balance must be at least 0.',
            
            
        ]);

      
        $tutorId = $request->input('editId_tutor');
        $name = $request->input('editName_tutor');
        $email = $request->input('editEmail_tutor');
        $balance = $request->input('editBalance_tutor');
        $tutorProfile = TutorProfile::find($tutorId);
        $user = User::find($tutorProfile->user_id);

        // Update tutor profile
        $tutorProfile->balance = $balance;
        $tutorProfile->save();

        // Update associated user details
        $user->name = $name;
        $user->email = $email;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Tutor details updated successfully!');
    }

    public function editStudent(Request $request)
    {
        $request->validate([
            'editId_student' => 'required|integer|exists:student_profiles,id',
            'editName_student' => 'required|string|max:255',
            'editEmail_student' => 'required|email|max:255|unique:users,email,' . $request->input('editId_student'),
            'editBalance_student' => 'required|numeric|min:0',],[
                'editEmail_student.unique' => 'The email has already been taken by another user.',
                'editBalance_student.min' => 'The balance must be at least 0.', 
        ]);

      
        $studentId = $request->input('editId_student');
        $name = $request->input('editName_student');
        $email = $request->input('editEmail_student');
        $balance = $request->input('editBalance_student');
        $studentProfile = StudentProfile::find($studentId);
        $user = User::find($studentProfile->user_id);

        // Update student profile
        $studentProfile->balance = $balance;
        $studentProfile->save();

        // Update associated user details
        $user->name = $name;
        $user->email = $email;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Student details updated successfully!');
    }

    public function editBooking(Request $request)
    {
    
        try{
            $request->validate([
            'editId_booking' => 'required|integer|exists:bookings,id',
            'editStatus2_booking' => 'required|string|in:pending,confirmed,completed,canceled',
        ]);
        }
        catch(\Illuminate\Validation\ValidationException $e)
        {
            dd($request->all());
            return redirect()->route('admin.dashboard')->with('error', 'Invalid input data!');
        }
        

        
        $bookingId = $request->input('editId_booking');
        $status = $request->input('editStatus2_booking');

        $booking = Booking::find($bookingId);

        // Update booking status
        $booking->status = $status;
        $booking->save();

        return redirect()->route('admin.dashboard')->with('success', 'Booking details updated successfully!');
    }

    public function addAccount(Request $request)
    {
      
            $request->validate([
                'role_addAccount' => 'required|string|in:tutor,student',
                'addName_addAccount' => 'required|string|max:255',
                'addEmail_addAccount' => 'required|email|max:255|unique:users,email',
                'addPassword_addAccount' => 'required|string|min:8|confirmed',],[
                    'addEmail_addAccount.unique' => 'The email has already been taken by another user.',
            ]);
        
        $role = $request->input('role_addAccount');
        $name = $request->input('addName_addAccount');
        $email = $request->input('addEmail_addAccount');
        $password = bcrypt($request->input('addPassword_addAccount'));

        // Create User
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);

        // Create corresponding profile
        if ($role === 'tutor') {
            TutorProfile::create([
                'user_id' => $user->id,
                'balance' => 0,
            ]);
        } elseif ($role === 'student') {
            StudentProfile::create([
                'user_id' => $user->id,
                'balance' => 0,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Account created successfully!');
    }
}