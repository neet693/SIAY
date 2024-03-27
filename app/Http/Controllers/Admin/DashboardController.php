<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Transaction;
use App\Models\TransactionType;
use Exception;
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
        $transaction_type_id = $request->input('transaction_type_id');
        $student_id = $request->input('student_id');

        // Fetch the transaction type and student data first
        $transaction_type = TransactionType::findOrFail($transaction_type_id);
        $student = Student::findOrFail($student_id);

        // Assign a new transaction to the student here
        $transaction = new Transaction();
        $transaction->transaction_type_id = $transaction_type_id;
        $transaction->student_id = $student_id;
        $transaction->price = $transaction_type->price;
        $transaction->midtrans_booking_code = $transaction->id . '-' . Str::random(5);

        $transaction_details = [
            'order_id' => $transaction->midtrans_booking_code,
            'gross_amount' => $transaction->price,
        ];

        $item_details = [
            [
                'id' => $transaction->midtrans_booking_code,
                'price' => $transaction->price,
                'quantity' => 1,
                'name' => "Pembayaran {$transaction_type->name} {$transaction->student->fullname}",
            ],
        ];

        $userData = [
            'first_name' => $transaction->student->fullname,
            'last_name' => "",
            'postal_code' => "",
            'address' => $transaction->student->studentAddress->address,
            'email' => $transaction->student->email,
            'country_code' => "IDN",
        ];

        $customer_details = [
            'first_name' => $transaction->student->fullname,
            'last_name' => "",
            'email' => $transaction->student->email,
            'billing_address' => $userData,
            'shipping_address' => $userData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $transaction->midtrans_url = $paymentUrl;
            $transaction->save();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // You may need to update the transaction data to store all required information,
        // and then redirect the user to the appropriate page.

        return redirect()->back()->with('message', 'Payment assigned successfully!');
    }
}
