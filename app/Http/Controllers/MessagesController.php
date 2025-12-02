<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\messages;
use App\Models\User;
use App\Models\Booking;

class MessagesController extends Controller
{
    //
    public function open(Request $request)
    {
        $bookingId = $request->query('booking_id');

        $bookingIds = Booking::find($bookingId);


        // Fetch messages related to the booking
        $messages = messages::where('booking_id', $bookingId)
                    ->orderBy('created_at', 'asc')
                    ->get();
        
        $receiver_name = $bookingIds->tutor->user->name?? 'Tutor';
        $receiver = $bookingIds->tutor->profile_picture;

        $user = auth()->user();
        return view('dashboard-chat', 
        compact(
        'messages', 
        'user', 
        'bookingId',
        'receiver_name',
        'receiver',
        ));
    }

    public function open_tutor(Request $request)
    {
        $bookingId = $request->query('booking_id');

        $bookingIds = Booking::find($bookingId);


        // Fetch messages related to the booking
        $messages = messages::where('booking_id', $bookingId)
                    ->orderBy('created_at', 'asc')
                    ->get();
        
        $receiver_name = $bookingIds->student->user->name?? 'Student';
        $receiver = $bookingIds->student->profile_picture;

        $user = auth()->user();

        return view('dashboard-chat', 
        compact(
        'messages', 
        'user', 
        'bookingId',
        'receiver_name',
        'receiver',
        ));
    }

    public function store(Request $request)
    {

        $request->validate([
            'booking_id' => 'required|integer',
            'sender_id' => 'required|integer',
            'message' => 'required|string',
        ]);

        // Safely create message
        $message = messages::create($request->only(['booking_id', 'sender_id', 'message']));
        return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
    }


    public function fetch(Request $request)
    {
        $bookingId = $request->booking_id;
        $lastId = $request->last_id ?? 0;

        $messages = messages::where('booking_id', $bookingId)
                            ->where('id', '>', $lastId)
                            ->orderBy('id', 'asc')
                            ->get();

        return response()->json($messages);
    }

}
