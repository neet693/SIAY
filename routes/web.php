<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/ppdb-success', function () {
    return view('success-ppdb');
})->name('ppdb-success');

Route::get('/detail/{transaction}', [TransactionController::class, 'detail'])->name('detail');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('students', StudentController::class);
Route::resource('ppdb', PPDBController::class);
Route::get('/transaction/process/{student_id}/{transaction_type_id}', [TransactionController::class, 'process'])->name('transaction.process');
Route::post('/midtrans-callback', [TransactionController::class, 'callback']);
