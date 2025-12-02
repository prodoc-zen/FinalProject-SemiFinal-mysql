<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\StudentProfile;
use App\Models\TutorProfile;
use App\Models\Payment;



use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $validatedData = $request->validate([
            'student_id' => 'required|exists:student_profiles,id',
            'tutor_id' => 'required|exists:tutor_profiles,id',
            'subject_id' => 'required|exists:subjects,id',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:30',
            'status' => 'required|string|max:50',
            'cost' => 'required|numeric|min:0',
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
        
        $studentProfile = StudentProfile::find($validatedData['student_id']);
        $tutorProfile = TutorProfile::find($validatedData['tutor_id']);

        if (!$studentProfile) {
            return back()->withErrors(['student_profile' => 'Student profile not found.']);
        }

        if (!$tutorProfile) {
            return back()->withErrors(['tutor_profile' => 'Tutor profile not found.']);
        }

        $studentProfile->balance -= $validatedData['cost'];
        $studentProfile->save();
        $tutorProfile->save();

        Booking::create($validatedData);

        Payment::create([
            'booking_id' => Booking::latest()->first()->id,
            'amount' => $validatedData['cost'],
            'paid_at' => now(),
        ]);
        

        return redirect()->back()->with('success', 'Booking created successfully!');
    }

    public function cancel(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // matches form input name
        ]);

        $booking = Booking::find($validatedData['booking_id']);

        if ($booking) {
            $booking->status = 'canceled';
            $booking->student->balance += $booking->cost;
            $booking->student->save();
            $booking->tutor->balance -= $booking->cost;
            $booking->tutor->save();
            $booking->save();

            return redirect()->route('student.dashboard')->with('success', 'Booking canceled successfully!');
        }

       
    }

    public function accept(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // matches form input name
        ]);

        $booking = Booking::find($validatedData['booking_id']);

        if ($booking) {
            $booking->status = 'confirmed'; // make sure spelling matches DB
            $booking->save();

            $payment = Payment::where('booking_id', $booking->id)->first();
            if ($payment) {
                $booking->tutor->balance += $payment->booking->cost;
                $booking->tutor->save();

                $payment->delete();
            }

            return redirect()->route('tutor.dashboard')->with('success', 'Booking accepted successfully!');
        }

        

        

        return redirect()->route('tutor.dashboard')->with('error', 'Booking not found.');
    }

    public function complete(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // matches form input name
        ]);

        $booking = Booking::find($validatedData['booking_id']);

        if ($booking) {
            $booking->status = 'completed'; // make sure spelling matches DB
            $booking->save();

            return redirect()->route('tutor.dashboard')->with('success', 'Booking completed successfully!');
        }

        return redirect()->route('tutor.dashboard')->with('error', 'Booking not found.');
    }

    public function reject(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // matches form input name
        ]);

        $booking = Booking::find($validatedData['booking_id']);

        if ($booking) {
            $booking->status = 'canceled';
            $booking->student->balance += $booking->cost;
            $booking->student->save();
            $booking->save();

            $payment = Payment::where('booking_id', $booking->id)->first();
            if ($payment) {
                $payment->delete();
            }

            return redirect()->route('tutor.dashboard')->with('success', 'Booking rejected successfully!');
        }
        return redirect()->route('tutor.dashboard')->with('error', 'Booking not found.');
    }

    public function reject2(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // matches form input name
        ]);

        $booking = Booking::find($validatedData['booking_id']);

        if ($booking) {
            $booking->status = 'canceled';
            $booking->tutor->balance -= $booking->cost;
            $booking->tutor->save();
            $booking->student->balance += $booking->cost;
            $booking->student->save();
            $booking->save();

            return redirect()->route('tutor.dashboard')->with('success', 'Booking rejected successfully!');
        }
        return redirect()->route('tutor.dashboard')->with('error', 'Booking not found.');
    }

    public function complete_student(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // matches form input name
        ]);

        $booking = Booking::find($validatedData['booking_id']);

        if ($booking) {
            $booking->status = 'completed'; // make sure spelling matches DB
            $booking->save();

            return redirect()->route('student.dashboard')->with('success', 'Booking completed successfully!');
        }

        return redirect()->route('student.dashboard')->with('error', 'Booking not found.');
    }


}
