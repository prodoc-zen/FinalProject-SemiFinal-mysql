<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\StudentProfile;
use App\Models\TutorProfile;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (strlen($request->password) < 8) {
        return back()
            ->withErrors(['password' => 'Password must be at least 8 characters long.'])
            ->withInput();
    }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,tutor'] 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // <-- save role
        ]);

        if ($request->role === 'student') {
            StudentProfile::create([
                'user_id' => $user->id,
            ]);
        } elseif ($request->role === 'tutor') {
            TutorProfile::create([
                'user_id' => $user->id,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // return redirect()->route('student.dashboard');
        if ($request->role === 'student') {
            return redirect()->route('student.dashboard');
        } elseif ($request->role === 'tutor') {
            return redirect()->route('tutor.dashboard');
        }
    }
}
