<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function process(Request $request, $student_id)
    {
        // Ambil data student berdasarkan student_id
        $student = Student::findOrFail($student_id);

        // Check if the student is already registered
        if (!$student->is_registered) {
            // If the student is not registered, set the transaction type to PPDB
            $transactionType = TransactionType::where('name', 'PPDB')->firstOrFail();
        } else {
            // If the student is already registered, get the appropriate transaction type
            $transactionType = TransactionType::where('name', 'Pembayaran Bulanan')->firstOrFail();
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => date('YmdHis') . '-' . $student->id, // 
                'gross_amount' => $transactionType->price,
            ),
            'customer_details' => array(
                'name' => $student->fullname,
                'email' => $student->email,
            ),
            'item_details' => array(
                array(
                    'id' => 'Pembayaran- ' . $student->id,
                    'price' => $transactionType->price,
                    'quantity' => 1,
                    'name' => $transactionType->name . $student->fullname,
                ),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction = new Transaction;
        $transaction->student_id = $student->id;
        $transaction->transaction_type_id = $transactionType->id;
        $transaction->is_success = false;
        $transaction->snap_token = $snapToken;
        $transaction->save();

        return view('PPDB.transfer', compact('snapToken', 'student'));
    }

    public function callback(Request $request)
    {
        // Ambil data transaction berdasarkan order_id
        $transaction = Transaction::where('order_id', $request->order_id)->firstOrFail();

        // Ambil data notifikasi
        $notification = new \Midtrans\Notification();

        // Cek status notifikasi
        if ($notification->status_code == '200') {
            if ($notification->transaction_status == 'settlement' || $notification->transaction_status == 'capture') {
                $transaction->is_success = true;
                $transaction->save();
            }
            if ($notification->transaction_status == 'capture') {
                if ($notification->fraud_status == 'challenge') {
                    // TODO Set payment status in merchant's database to 'challenge'
                } else if ($notification->fraud_status == 'accept') {
                    // TODO Set payment status in merchant's database to 'success'
                    $transaction->is_success = true;
                    $transaction->save();
                }
            } else if ($notification->transaction_status == 'cancel') {
                if ($notification->fraud_status == 'challenge') {
                    // TODO Set payment status in merchant's database to 'failure'
                } else if ($notification->fraud_status == 'accept') {
                    // TODO Set payment status in merchant's database to 'failure'
                    $transaction->is_success = false;
                    $transaction->save();
                }
            } else if ($notification->transaction_status == 'deny') {
                // TODO Set payment status in merchant's database to 'failure'
                $transaction->is_success = false;
                $transaction->save();
            }
        }

        // Jika gagal, redirect ke halaman error
        return redirect()->route('error');
    }
}



    // public function index()
    // {
    //     //
    // }


    // public function create()
    // {
    //     //
    // }


    // public function store(Request $request)
    // {
    //     //
    // }


    // public function show(Transaction $transaction)
    // {
    //     //
    // }

    // public function edit(Transaction $transaction)
    // {
    //     //
    // }

    // public function update(Request $request, Transaction $transaction)
    // {
    //     //
    // }

    // public function destroy(Transaction $transaction)
    // {
    //     //
    // }
