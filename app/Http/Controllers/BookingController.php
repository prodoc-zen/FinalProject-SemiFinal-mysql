<?php

namespace App\Http\Controllers;
use App\Models\Booking;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:student_profiles,id',
            'tutor_id' => 'required|exists:tutor_profiles,id',
            'subject_id' => 'required|exists:subjects,id',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:30',
            'status' => 'required|string|max:50',
        ]);

        Booking::create($validatedData);

        return redirect()->back()->with('success', 'Booking created successfully!');
    }

    public function cancel(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // matches form input name
        ]);

        $booking = Booking::find($validatedData['booking_id']);

        if ($booking) {
            $booking->status = 'canceled'; // make sure spelling matches DB
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
            $booking->status = 'canceled'; // make sure spelling matches DB
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
