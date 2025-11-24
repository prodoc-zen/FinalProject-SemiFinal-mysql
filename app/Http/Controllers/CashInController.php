<?php

namespace App\Http\Controllers;

use App\Models\CashIn;
use App\Models\StudentProfile;


use Illuminate\Http\Request;

class CashInController extends Controller
{
    public function cashIn(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // 1. Record the transaction
        CashIn::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'reference_number' => $request->reference_number,
        ]);

        // 2. AUTO update balance
        StudentProfile::where('user_id', auth()->id())
            ->increment('balance', $request->amount);

        return back()->with('success', 'Cash in successful!');
    }
}
