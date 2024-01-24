<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionType;
use Exception;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Midtrans\Config;
use Str;

class TransactionController extends Controller
{
    public function process(Request $request, $student_id, $transaction_type_id)
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is3ds');

        // Ambil data student berdasarkan student_id
        $student = Student::findOrFail($student_id);

        // Ambil data transaction type berdasarkan transaction_type_id
        $transactionType = TransactionType::findOrFail($transaction_type_id);

        // Check if there is already an unsuccessful transaction with the same student_id and transaction_type_id
        $existingTransaction = Transaction::where('student_id', $student_id)
            ->where('transaction_type_id', $transaction_type_id)
            ->where('payment_status', 'success')
            ->first();

        if ($existingTransaction) {
            // Redirect user to a success page or show a success message
            return redirect()->back()->with('success', 'Pembayaran berhasil.');
        }

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => date('YmdHis') . '-' . $student->id, //
        //         'gross_amount' => $transactionType->price,
        //     ),
        //     'customer_details' => array(
        //         'name' => $student->fullname,
        //         'email' => $student->email,
        //     ),
        //     'item_details' => array(
        //         array(
        //             'id' => 'Pembayaran PPDB - ' . $student->id,
        //             'price' => $transactionType->price,
        //             'quantity' => 1,
        //             'name' => $transactionType->name . ' ' . $student->fullname,
        //         ),
        //     ),
        // );

        $transaction = new Transaction;
        $orderId = $transaction->id . '-' . Str::random(5);
        $transaction->midtrans_booking_code = $orderId;
        $price = $transactionType->price;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price,
        ];

        $item_details[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Pembayaran {$transactionType->name}"
        ];

        $userData = [
            'first_name' => $student->fullname,
            'last_name' => "",
            'postal_code' => "",
            'address' => $student->studentAddress,
            'email' => $student->email,
            // 'phone' => $student->studentParent->dad_tel,
            'country_code' => "IDN"
        ];

        $customer_details = [
            'first_name' => $student->fullname,
            'last_name' => "",
            'email' => $student->email,
            // 'phone' => $student->studentParent->dad_tel,
            'billing_address' => $userData,
            'shipping_address' => $userData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,

        ];

        try {
            // Get Snap Payment Page URL
            // $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $transaction->student_id = $student->id;
            $transaction->transaction_type_id = $transactionType->id;
            $transaction->payment_status = 'waiting';
            $transaction->midtrans_url = $paymentUrl;
            $transaction->save();
            // Redirect to Snap Payment Page
            // return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return redirect($paymentUrl);
        // return view('PPDB.transfer', compact('student', 'transaction'));
    }

    public function callback(Request $request)
    {
        Config::$serverKey = config('midtrans.serverKey');

        $notif = $request->method() == 'POST' ? new Notification() : \Midtrans\Transaction::status($request->order_id);

        $transaction_id = explode('-', $notif->transaction_id);

        $transaction = Transaction::find($transaction_id[0]);

        if (!$transaction) {
            // Transaction not found in the database, return an error response
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                $transaction->payment_status = 'pending';
                // TODO Set payment status in merchant's database to 'challenge'
            } else if ($fraud == 'accept') {
                $transaction->payment_status = 'paid';
                // TODO Set payment status in merchant's database to 'success'
            }
        } else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                $transaction->payment_status = 'failed';
                // TODO Set payment status in merchant's database to 'failure'
            } else if ($fraud == 'accept') {
                $transaction->payment_status = 'failed';
                // TODO Set payment status in merchant's database to 'failure'
            }
        } else if ($transaction_status == 'deny') {
            $transaction->payment_status = 'failed';
            // TODO Set payment status in merchant's database to 'failure'
        } else if ($transaction_status == 'settlement') {
            $transaction->payment_status = 'paid';
            // TODO set payment status in merchant's database to 'Settlement'
        } else if ($transaction_status == 'pending') {
            $transaction->payment_status = 'pending';
            // TODO set payment status in merchant's database to 'Pending'
        } else if ($transaction_status == 'expire') {
            $transaction->payment_status = 'failed';
            // TODO set payment status in merchant's database to 'expire'
        }

        $transaction->save();

        return redirect()->route('checkout');
    }


    public function detail(Transaction $transaction)
    {
        $student = $transaction->student();
        return view('Transaction.detail', compact('transaction', 'student'));
    }
}
