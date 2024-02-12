<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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

// Route::get('/dashboard', function () {
//     return view('Dashboard.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('dashboard', DashboardController::class)->middleware(['auth', 'verified']);

Route::resource('interviews', InterviewController::class);

Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
