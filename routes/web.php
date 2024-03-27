<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [PPDBController::class, 'index'])->name('welcome');

Route::get('invoice', [PPDBController::class, 'invoice'])->name('invoice');

//midtrans routes
Route::resource('ppdb', PPDBController::class);
Route::get('/callback', [PPDBController::class, 'callback']);
Route::post('/callback', [PPDBController::class, 'callback']);


Route::resource('transaction', TransactionController::class);

// Route::resource('pay-now', PaymentController::class);
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('interview', InterviewController::class);
    Route::resource('transactiontype', TransactionTypeController::class);

    Route::post('/pay-now', [PaymentController::class, 'payNow'])->name('pay-now');
    Route::post('/process-payment', [PaymentController::class, 'process'])->name('process-payment');
    Route::get('/callback', [PaymentController::class, 'callback']);
    Route::post('/callback', [PaymentController::class, 'callback']);
    //Route Admin
    Route::prefix('admin/')->namespace('Admin')->name('admin.')->middleware('ensureStudentRole')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('students', [AdminStudentController::class, 'index'])->name('student');
        Route::get('students/{unique_code}', [AdminStudentController::class, 'show'])->name('student.show');
        Route::post('set-paid/{booking_code}', [AdminDashboardController::class, 'adminSetPaid'])->name('set.paid');
        Route::post('ppdb/{unique_code}/accept', [PPDBController::class, 'acceptPPDB'])->name('set.accept');
        Route::post('ppdb/{unique_code}/reject', [PPDBController::class, 'rejectPPDB'])->name('set.reject');
        Route::get('assign-payment', [AdminDashboardController::class, 'assignPaymentChecklist'])->name('assignment.payment');
        Route::post('assign-payment', [AdminDashboardController::class, 'assignPayment'])->name('payment.assign');
    });


    //Route Student
    Route::prefix('student/')->namespace('Student')->name('student.')->middleware('ensureStudentRole')->group(function () {
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('{unique_code}', [StudentDashboardController::class, 'show'])->name('student.show');
    });



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware('auth', 'is_admin')->group(function () {
//     Route::group([
//         'prefix' => 'admin',
//         'as' => 'admin.'
//     ], function () {
//         Route::resource('dashboard', DashboardController::class);
//         Route::resource('interviews', InterviewController::class);
//         Route::resource('students', StudentController::class);
//         Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//         Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//         Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     });
// });

// Route::middleware('auth', 'is_student')->group(function () {
//     Route::group([
//         'prefix' => 'student',
//         'as' => 'student.'
//     ], function () {
// Route::resource('dashboard', StudentDashboardController::class);
//         Route::resource('interviews', InterviewController::class);
//         Route::resource('students', StudentController::class);
//         Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//         Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//         Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     });
// });

require __DIR__ . '/auth.php';
