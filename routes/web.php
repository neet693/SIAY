<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InterviewController as AdminInterviewController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('invoice', [PPDBController::class, 'invoice'])->name('invoice');
Route::resource('ppdb', PPDBController::class);

//midtrans routes
Route::get('/callback', [PPDBController::class, 'callback']);
Route::post('/callback', [PPDBController::class, 'callback']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('interviews', InterviewController::class);
    //Route Admin
    Route::prefix('admin/')->namespace('Admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/students', [AdminStudentController::class, 'index'])->name('student');
        Route::get('/students/{student}', [AdminStudentController::class, 'show'])->name('student.show');
        Route::get('/interviews', [AdminInterviewController::class, 'index'])->name('interview');
    });


    //Route Student
    Route::prefix('student/')->namespace('Student')->name('student.')->group(function () {
        // Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/students/{student}', [StudentDashboardController::class, 'show'])->name('student.show');
        Route::get('interviews/create', [InterviewController::class, 'create'])->name('interviews.create');
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
