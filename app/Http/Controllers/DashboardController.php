<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $parents = StudentParent::all();
        // $totalPrice = Transaction::where('is_success', true)->where('transaction_type', 'PPDB')->sum('price');

        $PPDBTransaction = Transaction::where('transaction_type_id', 1)->first();

        // Jika transaksi ditemukan, ambil total harga transaksi
        if ($PPDBTransaction) {
            $totalPrice = $PPDBTransaction->transactionType->sum('price');
        }
        return view('Dashboard.index', compact('students', 'parents', 'totalPrice'));
    }
}
