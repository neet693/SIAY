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
    // public function process(Request $request, $student_id)
    // {
    //     // Ambil data student berdasarkan student_id
    //     $student = Student::findOrFail($student_id);

    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = config('midtrans.serverKey');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => $student->id, //
    //             'gross_amount' => 150000,
    //         ),
    //         'customer_details' => array(
    //             'name' => $student->fullname,
    //             'email' => $student->email,
    //         ),
    //         'item_details' => array(
    //             array(
    //                 'id' => 'PPDB- ' . $student->id,
    //                 'price' => 150000,
    //                 'quantity' => 1,
    //                 'name' => 'Pembayaran PPDB' . $student->fullname,
    //             ),
    //         ),
    //     );

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);

    //     $student->snap_token = $snapToken;
    //     $student->save();

    //     return view('PPDB.transfer', compact('snapToken', 'student'));
    // }
}
