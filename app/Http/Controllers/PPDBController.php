<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePPDBRequest;
use App\Mail\PPDBRegistrationSuccess;
use App\Models\Interview;
use App\Models\PPDB;
use App\Models\SchoolInformation;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentParent;
use App\Models\StudentParentAddress;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wali;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Illuminate\Support\Str;

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

    public function store(StorePPDBRequest $request)
    {
        // Validasi input
        $request->validate([
            'education_level_id' => 'required',
            'academic_year_id' => 'required',
            'news_from' => 'required',
            'last_school' => 'required',
            'fullname' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'citizenship' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'religion_id' => 'required',
            'church_domicile' => 'required',
            'child_position' => 'required',
            'child_number' => 'required',
            'blood_type_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'residence_status_id' => 'required',
            'dad_tel' => 'required',
            'mom_tel' => 'required',
            'dad_name' => 'required|string|max:255',
            'mom_name' => 'required|string|max:255',
            'dad_degree' => 'required',
            'mom_degree' => 'required',
            'dad_job' => 'required',
            'mom_job' => 'required',
            'parent_province' => 'required',
            'parent_regency' => 'required',
            'parent_district' => 'required',
            'parent_village' => 'required',
            'address' => 'required',
            'parentStay' => 'required',
            'transaction_type_id' => 'required',
            'title' => 'required',
            'interview_date' => 'required',
            'method' => 'required',
        ]);

        // Step 1: Create School Information
        $schoolInformation = SchoolInformation::create([
            'academic_year_id' => $request->input('academic_year_id'),
            'education_level_id' => $request->input('education_level_id'),
            'news_from' => $request->input('news_from'),
            'last_school' => $request->input('last_school'),
        ]);

        if (!$schoolInformation) {
            return redirect()->back()->withErrors('Error creating school information.')->withInput();
        }

        // Step 2: Check for duplicate email
        $email = $request->input('email');
        if (User::where('email', $email)->exists()) {
            return redirect()->back()->withErrors('Email Sudah Pernah Digunakan.')->withInput();
        }

        // Step 3: Create User
        $user = User::create([
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'role_id' => 3,
            'password' => bcrypt('sekolahyahya*'),
        ]);

        if (!$user) {
            return redirect()->back()->withErrors('Error creating user.')->withInput();
        }

        // Generate Unique Code
        $academicYear = substr($schoolInformation->academicYear->name, 2, 2) . substr($schoolInformation->academicYear->name, -2, 2);
        $uniqueCode = $schoolInformation->educationLevel->level_name . '-' . $academicYear . '-' . sprintf("%04d", $schoolInformation->id);

        // Step 4: Create Student
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
            'status_penerimaan' => 'Menunggu Persetujuan',
        ]);

        if (!$student) {
            return redirect()->back()->withErrors('Error creating student.')->withInput();
        }

        // Step 5: Create Student Parent
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

        if (!$studentParent) {
            return redirect()->back()->withErrors('Error creating student parent.')->withInput();
        }

        // Step 6: Create Student Parent Address
        $studentParentAddress = $studentParent->studentParentAddress()->create([
            'parent_province' => $request->input('parent_province'),
            'parent_regency' => $request->input('parent_regency'),
            'parent_district' => $request->input('parent_district'),
            'parent_village' => $request->input('parent_village'),
            'address' => $request->input('address'),
            'parentStay' => $request->input('parentStay'),
        ]);

        if (!$studentParentAddress) {
            return redirect()->back()->withErrors('Error creating student parent address.')->withInput();
        }

        // Step 7: Create Student Address if needed
        if ($request->input('residence_status_id') == 1) {
            $student->studentAddress()->create([
                'student_province' => $studentParentAddress->parent_province,
                'student_regency' => $studentParentAddress->parent_regency,
                'student_district' => $studentParentAddress->parent_district,
                'student_village' => $studentParentAddress->parent_village,
                'address' => $studentParentAddress->address,
            ]);
        } else {
            $wali = Wali::create([
                'student_id' => $student->id,
                'wali_name' => $request->input('wali_name'),
                'wali_degree' => $request->input('wali_degree'),
                'wali_job' => $request->input('wali_job'),
                'wali_address' => $request->input('wali_address'),
                'wali_tel' => $request->input('wali_tel'),
            ]);
            $studentAddress = $student->studentAddress()->create([
                'student_province' => $request->input('student_province_name'),
                'student_regency' => $request->input('student_regency_name'),
                'student_district' => $request->input('student_district_name'),
                'student_village' => $request->input('student_village_name'),
                'address' => $request->input('address'),
            ]);

            if (!$studentAddress) {
                return redirect()->back()->withErrors('Error creating student address.')->withInput();
            }

            if (!$wali) {
                return redirect()->back()->withErrors('Error creating wali.')->withInput();
            }
        }

        // Step 8: Create Interview
        $interview = Interview::create([
            'title' => $request->input('title'),
            'interview_date' => $request->input('interview_date'),
            'status' => 'Dijadwalkan',
            'method' => $request->input('method'),
            'reason' => $request->input('reason'),
            'user_id' => $user->id,
        ]);

        if (!$interview) {
            return redirect()->back()->withErrors('Error creating interview.')->withInput();
        }

        // Save Student and Interview data
        $student->school_information_id = $schoolInformation->id;
        $student->save();
        $interview->save();

        // Send student credentials
        $this->sendStudentCredential($student->id, $user->password);
        $this->sendTelegramNotification($student);

        // Return success view
        return view('PPDB.success', compact('student'));
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
            return redirect(route('welcome'));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return redirect(route('welcome'));
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
        $interview = Interview::where('user_id', $student->user_id)->first(); // Mengambil informasi wawancara berdasarkan user_id
        Mail::to($student->email)->send(new PPDBRegistrationSuccess($student, $password, $interview));
        return redirect()->back()->with('success', 'Email kredensial telah dikirim ke student.');
    }

    private function sendTelegramNotification($student)
    {
        $fullname = $student->fullname;
        $level = $student->schoolInformation->educationLevel->level_name;
        $createdAt = $student->created_at->timezone('Asia/Jakarta');
        $telegramToken = env('TELEGRAM_BOT_TOKEN');
        $chatIds = env('TELEGRAM_CHAT_IDS');

        $message = "*Notifikasi Pendaftaran PPDB*\n👤 Nama Siswa: $fullname\n📚 Unit: $level\n🗓 Tanggal Daftar: " . $createdAt->format('d M Y');

        // Loop melalui setiap chat ID dan kirimkan notifikasi
        if (!$telegramToken || !$chatIds) {
            Log::warning('Telegram notification skipped due to missing credentials.');
            return;
        }

        try {
            // Mengubah $chatIds menjadi array jika belum dalam bentuk array
            $chatIdsArray = explode(',', $chatIds); // Asumsi $chatIds dipisahkan koma dalam .env

            foreach ($chatIdsArray as $chatId) {
                Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $message
                ]);
            }
        } catch (Exception $e) {
            Log::error('Failed to send Telegram notification: ' . $e->getMessage());
        }
    }


    public function print($uniqueCode)
    {
        $student = Student::where('unique_code', $uniqueCode)->firstOrFail();

        return view('print-formulir', compact('student'));
    }
}
