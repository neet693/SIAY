<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Str;

class PaymentController extends Controller
{
    // Constructor
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

    public function index()
    {
        //
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
        $transactionType = TransactionType::find($request->input('transaction_type_id'));
        $price = $transactionType->price;

        $transaction = Transaction::create([
            'student_id' => Auth()->id,
            'transaction_type_id' => $request->input('transaction_type_id'),
            'paymet_status' => 'waiting',
            'price' => $price,
        ]);
        $this->process($transaction);
        return redirect()->away($transaction->midtrans_url);
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

    public function payNow(Request $request)
    {
        $transaction_id = $request->input('transaction_id');
        $transaction = Transaction::findOrFail($transaction_id);

        $orderId = $transaction->id . '-' . Str::random(5);
        $transaction->midtrans_booking_code = $orderId;
        $price = $transaction->transactionType->price;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price,
        ];

        $item_details[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Pembayaran {$transaction->transactionType->name} {$transaction->student->fullname}"
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
            $transaction->payment_status = 'paid';
            $transaction->save(); // uncommented this line

            return redirect()->back();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return redirect()->back();
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
