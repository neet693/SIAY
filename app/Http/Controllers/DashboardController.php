<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $parents = StudentParent::all();
        $totalPrice = Transaction::where('is_success', true)->sum('price');
        return view('Dashboard.index', compact('students', 'parents', 'totalPrice'));
    }
}
