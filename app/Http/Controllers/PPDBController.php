<?php

namespace App\Http\Controllers;

use App\Mail\PPDBRegistrationSuccess;
use App\Models\PPDB;
use App\Models\SchoolInformation;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentParent;
use App\Models\StudentParentAddress;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Str;

class PPDBController extends Controller
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

    public function index()
    {
        $students = Student::where('status_penerimaan', 'Diterima')->get();
        return view('welcome', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('PPDB.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'education_level_id' => 'required',
            'academic_year_id' => 'required',
            'news_from' => 'required',
            'last_school' => 'required',
            'fullname' => 'required',
            'nickname' => 'required',
            'citizenship' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'religion_id' => 'required',
            'church_domicile' => 'required',
            'student_province' => 'required',
            'student_regency' => 'required',
            'student_district' => 'required',
            'student_village' => 'required',
            'address' => 'required',
            'child_position' => 'required',
            'child_number' => 'required',
            'blood_type_id' => 'required',
            'email' => 'required|email',
            'residence_status_id' => 'required',
            'dad_tel' => 'required',
            'mom_tel' => 'required',
            'dad_name' => 'required',
            'mom_name' => 'required',
            'dad_degree' => 'required',
            'mom_degree' => 'required',
            'dad_job' => 'required',
            'mom_job' => 'required',
            'parent_province' => 'required',
            'parent_regency' => 'required',
            'parent_district' => 'required',
            'parent_village' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
            'transaction_type_id' => 'required',
        ]);

        $schoolInformation = SchoolInformation::create([
            'academic_year_id' => $request->input('academic_year_id'),
            'education_level_id' => $request->input('education_level_id'),
            'news_from' => $request->input('news_from'),
            'last_school' => $request->input('last_school'),
        ]);
        $schoolInformation->save();

        //Create Student
        $user = User::create([
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'role_id' => 2,
            'password' => 'sekolahyahya*',
        ]);
        $user->save();

        //Generate Unique Code
        $academicYear = substr($schoolInformation->academicYear->name, 2, 2) . substr($schoolInformation->academicYear->name, -2, 2);
        $uniqueCode = $schoolInformation->educationLevel->level_name . '-' . $academicYear . '-' .  sprintf("%04d", $schoolInformation->id);

        // Step 2: Save Student Information
        $student = Student::create([
            'user_id' => $user->id,
            'school_information_id' => $schoolInformation->id,
            'unique_code' => $uniqueCode,
            'fullname' => $request->input('fullname'),
            'nickname' => $request->input('nickname'),
            'citizenship' => $request->input('citizenship'),
            'gender' => $request->input('gender'),
            'birth_place' => $request->input('birth_place'),
            'birth_date' => $request->input('birth_date'),
            'religion_id' => $request->input('religion_id'),
            'church_domicile' => $request->input('church_domicile'),
            'child_position' => $request->input('child_position'),
            'child_number' => $request->input('child_number'),
            'blood_type_id' => $request->input('blood_type_id'),
            'email' => $request->input('email'),
            'residence_status_id' => $request->input('residence_status_id'),
            'payment_method' => $request->input('payment_method'),
            'status_penerimaan' => 'Menunggu Persetujuan',
        ]);

        $student->studentAddress()->create([
            'student_province' => $request->input('student_province_name'),
            'student_regency' => $request->input('student_regency_name'),
            'student_district' => $request->input('student_district_name'),
            'student_village' => $request->input('student_village_name'),
            'address' => $request->input('address'),
        ]);

        // Step 3: Save Student Parent Information
        $studentParent = StudentParent::create([
            'student_id' => $student->id,
            'dad_name' => $request->input('dad_name'),
            'mom_name' => $request->input('mom_name'),
            'dad_degree' => $request->input('dad_degree'),
            'mom_degree' => $request->input('mom_degree'),
            'dad_job' => $request->input('dad_job'),
            'mom_job' => $request->input('mom_job'),
            'dad_tel' => $request->input('dad_tel'),
            'mom_tel' => $request->input('mom_tel'),
        ]);
        $studentParent->studentParentAddress()->create([
            'parent_province' => $request->input('parent_province_name'),
            'parent_regency' => $request->input('parent_regency_name'),
            'parent_district' => $request->input('parent_district_name'),
            'parent_village' => $request->input('parent_village_name'),
            'address' => $request->input('address'),
        ]);
        $transactionType = TransactionType::find($request->input('transaction_type_id'));
        $price = $transactionType->price;

        $transaction = Transaction::create([
            'student_id' => $student->id,
            'transaction_type_id' => $request->input('transaction_type_id'),
            'paymet_status' => 'waiting',
            'price' => $price,
        ]);
        $student->school_information_id = $schoolInformation->id;
        $student->save();

        if ($student->payment_method === 'Tunai') {
            $this->offlinePayment($transaction);
            $this->sendStudentCredential($student->id, $user->password);
            return view('PPDB.tunai', compact('student'));
        } elseif ($student->payment_method === 'Transfer') {
            $this->process($transaction);
            $this->sendStudentCredential($student->id, $user->password);
            return redirect()->away($transaction->midtrans_url);
        }
    }

    public function process(Transaction $transaction)
    {
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
            'name' => "Pembayaran PPDB {$transaction->student->fullname}"
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
            $redirectUrl = "https://217e-182-253-123-112.ngrok-free.app?order_id={$orderId}&status_code=200&transaction_status=settlement";
            return redirect($redirectUrl);
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

        if ($transaction->payment_status == 'paid') {
            return redirect()->route('invoice');
        }
    }

    public function offlinePayment(Transaction $transaction)
    {
        $orderId = $transaction->id . '-' . Str::random(5);
        $transaction->midtrans_booking_code = $orderId;
        $transaction->payment_status = 'pending';
        $transaction->save();
    }


    public function invoice()
    {
        return view('Invoice');
    }

    public function adminSetPaid(Transaction $transaction, $midtransBookingCode)
    {
        $transaction = Transaction::where('midtrans_booking_code', $midtransBookingCode)->firstOrFail();
        $transaction->payment_status = 'paid';
        $transaction->save();

        return redirect()->back();
    }

    public function acceptPPDB(Request $request, $uniqueCode)
    {
        $student = Student::where('unique_code', $uniqueCode)->firstOrFail();
        $student->status_penerimaan = 'Diterima';
        $student->save();

        return redirect()->back()->with('success', 'PPDB diterima');
    }

    public function rejectPPDB(Request $request, $uniqueCode)
    {
        $student = Student::where('unique_code', $uniqueCode)->firstOrFail();
        $student->status_penerimaan = 'Ditolak';
        $student->save();

        return redirect()->back()->with('success', 'PPDB ditolak');
    }

    public function sendStudentCredential($student_id, $password)
    {
        $student = Student::findOrFail($student_id);
        Mail::to($student->email)->send(new PPDBRegistrationSuccess($student, $password));
        return redirect()->back()->with('success', 'Email kredensial telah dikirim ke student.');
    }
}
