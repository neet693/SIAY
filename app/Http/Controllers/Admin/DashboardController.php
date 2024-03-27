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
use Midtrans\Config;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is3ds');
    }
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

        $transaction_type = TransactionType::findOrFail($transaction_type_id);
        $student = Student::findOrFail($student_id);

        $transaction = new Transaction();
        $transaction->transaction_type_id = $transaction_type_id;
        $transaction->student_id = $student_id;
        $transaction->price = $transaction_type->price;
        $transaction->midtrans_booking_code = $transaction_type_id . '-' . Str::random(5);

        $transaction_details = [
            'order_id' => $transaction->midtrans_booking_code,
            'gross_amount' => $transaction->price,
        ];

        $item_details[] = [
            'id' => $transaction->midtrans_booking_code,
            'price' => $transaction->price,
            'quantity' => 1,
            'name' => "Pembayaran {$transaction->transactionType->name}"
        ];

        $userData = [
            'first_name' => $transaction->student->fullname,
            'last_name' => "",
            'postal_code' => "",
            'address' => $transaction->student->studentAddress->address,
            'email' => $transaction->student->email,
            'country_code' => "IDN"
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
            return redirect()->back();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        $notif = $request->method() == 'POST' ? new \Midtrans\Notification() : \Midtrans\Transaction::status($request->order_id);

        $transaction_id = explode('-', $notif->order_id);

        $transaction = Transaction::find($transaction_id[0]);
        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                $transaction->payment_status = 'pending';
            } else if ($fraud == 'accept') {
                $transaction->payment_status = 'paid';
                return redirect(route('welcome'));
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                $transaction->payment_status = 'pending';
            } else if ($fraud == 'accept') {
                $transaction->payment_status = 'failed';
            }
        } else if ($transaction_status == 'deny') {
            $transaction->payment_status = 'failed';
        } else if ($transaction_status == 'settlement') {
            $transaction->payment_status = 'paid';
        } else if ($transaction_status == 'pending') {
            $transaction->payment_status = 'pending';
        } else if ($transaction_status == 'expire') {
            $transaction->payment_status = 'failed';
        }

        $transaction->save();
        return redirect(route('welcome'));
    }
}
