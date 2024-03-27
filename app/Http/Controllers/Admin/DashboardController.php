<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Str;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $parents = StudentParent::all();
        $transactions = Transaction::all();
        $PPDBPaid = Transaction::where('transaction_type_id', 1)
            ->where('payment_status', 'paid')
            ->sum('price');

        $PPDBUnpaid = Transaction::where('transaction_type_id', 1)
            ->where('payment_status', 'pending')
            ->sum('price');

        return view('Admin.Dashboard.index', compact(
            'students',
            'parents',
            'PPDBPaid',
            'PPDBUnpaid',
            'transactions'

        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function paymentAssign()
    {
        $transactionTypes = TransactionType::all();

        return view('Admin.Dashboard.payment-assign', compact('transactionTypes'));
    }

    public function assignPaymentChecklist()
    {
        $transactions = Transaction::all();
        $students = Student::all();
        $transactionTypes = TransactionType::all();
        $assignedPayments = Transaction::whereNotNull('student_id')->with('student', 'transactionType')->get();

        return view('Admin.Dashboard.payment-assign', compact(
            'transactions',
            'transactionTypes',
            'students',
            'assignedPayments'
        ));
    }

    public function assignPayment(Request $request)
    {

        // Get the transaction type
        $transactionTypeId = $request->input('transaction_type_id');
        $student_id = $request->input('student_id');

        if (!$transactionTypeId) {
            return redirect()->back()->with('error', 'Maaf, transaksi belum dipilih.');
        }

        // Create a new transaction
        $transaction = new Transaction();
        $transaction->transaction_type_id = $transactionTypeId;
        $transaction->student_id = $student_id;
        $transaction->price = TransactionType::where('id', $transactionTypeId)->value('price');
        $orderId = $transactionTypeId . '-' . Str::random(5);
        $transaction->midtrans_booking_code = $orderId;
        $transaction->payment_status = 'pending';

        $transaction->save();

        return redirect()->back();
    }
}
