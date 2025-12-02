<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TutorProfileController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CashInController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Admin;




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
    Route::post('/booking/cancel2', [BookingController::class, 'reject2'])->name('booking.reject2');
    Route::post('/booking/complete/student', [BookingController::class, 'complete_student'])->name('booking-student.complete');

    //profile
    Route::post('/tutor/profile/update', [TutorProfileController::class, 'updateProfile_tutor'])->name('tutor.profile.update');
    Route::post('/student/profile/update', [StudentProfileController::class, 'updateProfile_student'])->name('student.profile.update');

    //cash in
    Route::post('/student/cashin', [CashInController::class, 'cashIn'])->name('student.cashin');


    Route::get('/chat', [MessagesController::class, 'open'])->name('chat.open');
    Route::get('/chat/tutor', [MessagesController::class, 'open_tutor'])->name('tutor.chat.open');

    //messaging
    Route::post('/messages/store', [MessagesController::class, 'store'])->name('messages.store');
    Route::get('/messages/fetch', [MessagesController::class, 'fetch']);


    //admin
    Route::get('/admin-dashboard', [Admin::class, 'adminDashboard'])->name('admin.dashboard');

    //admin - delete
    Route::post('/admin/delete-user', [Admin::class, 'deleteUser'])->name('admin.user.delete');
    Route::post('/admin/delete-booking', [Admin::class, 'deleteBooking'])->name('admin.booking.delete');
    Route::post('/admin/delete-student', [Admin::class, 'deleteStudent'])->name('admin.student.delete');
    Route::post('/admin/delete-tutor', [Admin::class, 'deleteTutor'])->name('admin.tutor.delete');


    //admin- edit
    Route::post('/admin/edit-tutor', [Admin::class, 'editTutor'])->name('admin.tutor.edit');
    Route::post('/admin/edit-student', [Admin::class, 'editStudent'])->name('admin.student.edit');
    Route::post('/admin/edit-booking', [Admin::class, 'editBooking'])->name('admin.booking.edit');

    //admin - add
    Route::post('/admin/add-account', [Admin::class, 'addAccount'])->name('admin.account.add');





});







require __DIR__.'/auth.php';
