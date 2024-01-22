<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Midtrans\Notification;

class TransactionController extends Controller
{
    public function process(Request $request, $student_id, $transaction_type_id)
    {

        $uniqueKey = 'payment_process_' . $student_id . '_' . $transaction_type_id;

        // Check if the unique key exists in the cache
        if (cache()->has($uniqueKey)) {
            // Redirect to an error page
            return redirect()->route('students.index');
        }
        // Ambil data student berdasarkan student_id
        $student = Student::findOrFail($student_id);

        // Ambil data transaction type berdasarkan transaction_type_id
        $transactionType = TransactionType::findOrFail($transaction_type_id);

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
                    'name' => $transactionType->name . ' ' . $student->fullname,
                ),
            ),
        );
        cache()->put($uniqueKey, true, now()->addMinute());

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction = new Transaction;
        $transaction->student_id = $student->id;
        $transaction->transaction_type_id = $transactionType->id;
        $transaction->is_success = false; // Set status sukses transaksi ke false sebelum proses transaksi dilakukan
        $transaction->snap_token = $snapToken;
        $transaction->price = $transactionType->price;
        $transaction->save();

        return view('PPDB.transfer', compact('snapToken', 'student', 'transaction'));
    }

    public function callback(Request $request)
    {
        // Ambil data transaction berdasarkan order_id
        $transaction = Transaction::where('order_id', $request->order_id)->firstOrFail();

        // Ambil data notifikasi
        $notification = new Notification();

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
