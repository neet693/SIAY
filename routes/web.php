<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PPDBController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('students', StudentController::class);
Route::resource('ppdb', PPDBController::class);
Route::get('/ppdb/process/{student_id}', [PPDBController::class, 'process'])->name('ppdb.process');
