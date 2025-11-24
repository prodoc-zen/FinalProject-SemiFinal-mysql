<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\BookingController;



Route::get('/', function () {
    return view('welcome-new');
});

Route::get('/force-logout', function () {
    Auth::logout();
    Session::flush(); // clears all session data
    return redirect('/login')->with('success', 'You have been logged out!');
})->name('force.logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/student-dashboard', [StudentProfileController::class, 'studentDashboard'])->name('student.dashboard');
    Route::get('/tutor-dashboard', [TutorProfileController::class, 'tutorDashboard'])->name('tutor.dashboard');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    //tutor
    Route::post('/booking/accept', [BookingController::class, 'accept'])->name('booking.accept');
    Route::post('/booking/complete', [BookingController::class, 'complete'])->name('booking.complete');
    Route::post('/booking/reject', [BookingController::class, 'reject'])->name('booking.reject');
    Route::post('/booking/complete/student', [BookingController::class, 'complete_student'])->name('booking-student.complete');

});







require __DIR__.'/auth.php';
