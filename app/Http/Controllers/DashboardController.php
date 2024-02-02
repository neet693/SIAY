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
        $totalPPDBPayment = Transaction::where('transaction_type_id', 1)
            ->where('payment_status', 'paid')
            ->sum('price');

        return view('Dashboard.index', compact('students', 'parents', 'totalPPDBPayment'));
    }
}
