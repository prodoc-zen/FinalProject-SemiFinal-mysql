<?php

namespace App\Http\Controllers;

use App\Models\CashIn;
use App\Models\StudentProfile;




use Illuminate\Http\Request;

class CashInController extends Controller
{
    public function cashIn(Request $request)
    {
        try{
            $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
        
        $user = auth()->user();
        $student = StudentProfile::where('user_id', $user->id)->first();

        CashIn::create([
            'student_id' => $student->id,
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('payment_method'),
        ]);

        // Update the student's balance
        $student->increment('balance', $request->input('amount'));

        return back()->with('success', 'Cash in successful!');
    }
}
