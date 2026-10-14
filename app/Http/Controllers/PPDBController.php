<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePPDBRequest;
use App\Mail\PPDBRegistrationSuccess;
use App\Models\AcademicYear;
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
use App\Http\Controllers\SchoolBannerController;

class PPDBController extends Controller
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');

        // Set to Development/Sandbox Environment
        // Set to true for Production Environment
        Config::$isProduction = config('midtrans.isProduction');

        // Set sanitization on
        Config::$isSanitized = config('midtrans.isSanitized');

        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is3ds');
    }

    public function index()
    {
        $students = Student::where('status_penerimaan', 'Diterima')->get();

        return view('welcome', compact(
            'students',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academicYears = AcademicYear::where('is_active', true)->get();

        return view('PPDB.create', compact('academicYears'));
    }

    public function store(StorePPDBRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        |
        | StorePPDBRequest sudah melakukan validasi utama.
        | Validasi tambahan di sini tetap dipertahankan agar
        | perilaku project lama tidak berubah.
        |
        */
    
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
    
    
        /*
        |--------------------------------------------------------------------------
        | NORMALIZE DATA UNTUK PENGECEKAN DUPLIKAT
        |--------------------------------------------------------------------------
        */
    
        $fullname = trim($request->input('fullname'));
    
        $birthDate = $request->input('birth_date');
    
        $academicYearId = $request->input('academic_year_id');
    
        $educationLevelId = $request->input('education_level_id');
    
        $dadTel = preg_replace(
            '/[^0-9]/',
            '',
            $request->input('dad_tel')
        );
    
        $momTel = preg_replace(
            '/[^0-9]/',
            '',
            $request->input('mom_tel')
        );
    
    
        /*
        |--------------------------------------------------------------------------
        | TRANSACTION
        |--------------------------------------------------------------------------
        |
        | Kita lock AcademicYear terlebih dahulu.
        |
        | Tujuannya:
        | Jika dua request masuk hampir bersamaan,
        | request kedua harus menunggu request pertama selesai.
        |
        */
    
        try {
    
            $result = DB::transaction(function () use (
                $request,
                $fullname,
                $birthDate,
                $academicYearId,
                $educationLevelId,
                $dadTel,
                $momTel
            ) {
    
                /*
                |--------------------------------------------------------------------------
                | LOCK TAHUN AJARAN
                |--------------------------------------------------------------------------
                */
    
                $academicYearRecord = AcademicYear::where(
                    'id',
                    $academicYearId
                )
                    ->lockForUpdate()
                    ->first();
    
                if (!$academicYearRecord) {
    
                    throw new Exception(
                        'Tahun ajaran tidak ditemukan.'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | CEK DUPLIKAT PENDAFTARAN
                |--------------------------------------------------------------------------
                |
                | Kombinasi:
                | - Nama
                | - Tanggal lahir
                | - Tahun ajaran
                | - Jenjang
                | - Nomor telepon ayah / ibu
                |
                */
    
                $duplicateStudent = Student::whereRaw(
                    'LOWER(TRIM(fullname)) = ?',
                    [strtolower($fullname)]
                )
                    ->whereDate(
                        'birth_date',
                        $birthDate
                    )
                    ->whereHas(
                        'schoolInformation',
                        function ($query) use (
                            $academicYearId,
                            $educationLevelId
                        ) {
    
                            $query
                                ->where(
                                    'academic_year_id',
                                    $academicYearId
                                )
                                ->where(
                                    'education_level_id',
                                    $educationLevelId
                                );
    
                        }
                    )
                    ->whereHas(
                        'studentParent',
                        function ($query) use (
                            $dadTel,
                            $momTel
                        ) {
    
                            $query->where(function ($q) use (
                                $dadTel,
                                $momTel
                            ) {
    
                                $q
                                    ->where(
                                        'dad_tel',
                                        $dadTel
                                    )
                                    ->orWhere(
                                        'mom_tel',
                                        $momTel
                                    )
                                    ->orWhere(
                                        'dad_tel',
                                        $momTel
                                    )
                                    ->orWhere(
                                        'mom_tel',
                                        $dadTel
                                    );
    
                            });
    
                        }
                    )
                    ->first();
    
    
                /*
                |--------------------------------------------------------------------------
                | JIKA SUDAH ADA
                |--------------------------------------------------------------------------
                */
    
                if ($duplicateStudent) {
    
                    throw new Exception(
                        'DUPLICATE_REGISTRATION|' .
                        $duplicateStudent->unique_code
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | CEK EMAIL
                |--------------------------------------------------------------------------
                |
                | Tetap dipertahankan sebagai pengaman tambahan.
                |--------------------------------------------------------------------------
                */
    
                $email = $request->input('email');
    
                if (User::where('email', $email)->exists()) {
    
                    throw new Exception(
                        'EMAIL_ALREADY_USED'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | STEP 1
                | CREATE SCHOOL INFORMATION
                |--------------------------------------------------------------------------
                */
    
                $schoolInformation =
                    SchoolInformation::create([
                        'academic_year_id' =>
                            $request->input(
                                'academic_year_id'
                            ),
    
                        'education_level_id' =>
                            $request->input(
                                'education_level_id'
                            ),
    
                        'news_from' =>
                            $request->input(
                                'news_from'
                            ),
    
                        'last_school' =>
                            $request->input(
                                'last_school'
                            ),
                    ]);
    
    
                if (!$schoolInformation) {
    
                    throw new Exception(
                        'Error creating school information.'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | STEP 2
                | CREATE USER
                |--------------------------------------------------------------------------
                */
    
                $user = User::create([
                    'name' =>
                        $request->input(
                            'fullname'
                        ),
    
                    'email' =>
                        $email,
    
                    'role_id' => 3,
    
                    'password' =>
                        bcrypt(
                            'sekolahyahya*'
                        ),
                ]);
    
    
                if (!$user) {
    
                    throw new Exception(
                        'Error creating user.'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | GENERATE UNIQUE CODE
                |--------------------------------------------------------------------------
                */
    
                $academicYear =
                    substr(
                        $schoolInformation
                            ->academicYear
                            ->name,
                        2,
                        2
                    )
                    .
                    substr(
                        $schoolInformation
                            ->academicYear
                            ->name,
                        -2,
                        2
                    );
    
    
                $uniqueCode =
                    $schoolInformation
                        ->educationLevel
                        ->level_name
                    . '-'
                    . $academicYear
                    . '-'
                    . sprintf(
                        "%04d",
                        $schoolInformation->id
                    );
    
    
                /*
                |--------------------------------------------------------------------------
                | STEP 3
                | CREATE STUDENT
                |--------------------------------------------------------------------------
                */
    
                $student = Student::create([
    
                    'user_id' =>
                        $user->id,
    
                    'school_information_id' =>
                        $schoolInformation->id,
    
                    'unique_code' =>
                        $uniqueCode,
    
                    'fullname' =>
                        $request->input(
                            'fullname'
                        ),
    
                    'nickname' =>
                        $request->input(
                            'nickname'
                        ),
    
                    'citizenship' =>
                        $request->input(
                            'citizenship'
                        ),
    
                    'gender' =>
                        $request->input(
                            'gender'
                        ),
    
                    'birth_place' =>
                        $request->input(
                            'birth_place'
                        ),
    
                    'birth_date' =>
                        $request->input(
                            'birth_date'
                        ),
    
                    'religion_id' =>
                        $request->input(
                            'religion_id'
                        ),
    
                    'church_domicile' =>
                        $request->input(
                            'church_domicile'
                        ),
    
                    'child_position' =>
                        $request->input(
                            'child_position'
                        ),
    
                    'child_number' =>
                        $request->input(
                            'child_number'
                        ),
    
                    'blood_type_id' =>
                        $request->input(
                            'blood_type_id'
                        ),
    
                    'email' =>
                        $request->input(
                            'email'
                        ),
    
                    'residence_status_id' =>
                        $request->input(
                            'residence_status_id'
                        ),
    
                    'status_penerimaan' =>
                        'Menunggu Persetujuan',
                ]);
    
    
                if (!$student) {
    
                    throw new Exception(
                        'Error creating student.'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | STEP 4
                | CREATE STUDENT PARENT
                |--------------------------------------------------------------------------
                */
    
                $studentParent =
                    StudentParent::create([
    
                        'student_id' =>
                            $student->id,
    
                        'dad_name' =>
                            $request->input(
                                'dad_name'
                            ),
    
                        'mom_name' =>
                            $request->input(
                                'mom_name'
                            ),
    
                        'dad_degree' =>
                            $request->input(
                                'dad_degree'
                            ),
    
                        'mom_degree' =>
                            $request->input(
                                'mom_degree'
                            ),
    
                        'dad_job' =>
                            $request->input(
                                'dad_job'
                            ),
    
                        'mom_job' =>
                            $request->input(
                                'mom_job'
                            ),
    
                        'dad_tel' =>
                            $request->input(
                                'dad_tel'
                            ),
    
                        'mom_tel' =>
                            $request->input(
                                'mom_tel'
                            ),
                    ]);
    
    
                if (!$studentParent) {
    
                    throw new Exception(
                        'Error creating student parent.'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | STEP 5
                | CREATE STUDENT PARENT ADDRESS
                |--------------------------------------------------------------------------
                */
    
                $studentParentAddress =
                    $studentParent
                        ->studentParentAddress()
                        ->create([
    
                            'parent_province' =>
                                $request->input(
                                    'parent_province'
                                ),
    
                            'parent_regency' =>
                                $request->input(
                                    'parent_regency'
                                ),
    
                            'parent_district' =>
                                $request->input(
                                    'parent_district'
                                ),
    
                            'parent_village' =>
                                $request->input(
                                    'parent_village'
                                ),
    
                            'address' =>
                                $request->input(
                                    'address'
                                ),
    
                            'parentStay' =>
                                $request->input(
                                    'parentStay'
                                ),
                        ]);
    
    
                if (!$studentParentAddress) {
    
                    throw new Exception(
                        'Error creating student parent address.'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | STEP 6
                | CREATE STUDENT ADDRESS
                |--------------------------------------------------------------------------
                */
    
                if (
                    $request->input(
                        'residence_status_id'
                    ) == 1
                ) {
    
                    $student->studentAddress()->create([
    
                        'student_province' =>
                            $studentParentAddress
                                ->parent_province,
    
                        'student_regency' =>
                            $studentParentAddress
                                ->parent_regency,
    
                        'student_district' =>
                            $studentParentAddress
                                ->parent_district,
    
                        'student_village' =>
                            $studentParentAddress
                                ->parent_village,
    
                        'address' =>
                            $studentParentAddress
                                ->address,
                    ]);
    
                } else {
    
                    /*
                    |--------------------------------------------------------------------------
                    | WALI
                    |--------------------------------------------------------------------------
                    */
    
                    $wali = Wali::create([
    
                        'student_id' =>
                            $student->id,
    
                        'wali_name' =>
                            $request->input(
                                'wali_name'
                            ),
    
                        'wali_degree' =>
                            $request->input(
                                'wali_degree'
                            ),
    
                        'wali_job' =>
                            $request->input(
                                'wali_job'
                            ),
    
                        'wali_address' =>
                            $request->input(
                                'wali_address'
                            ),
    
                        'wali_tel' =>
                            $request->input(
                                'wali_tel'
                            ),
                    ]);
    
    
                    $studentAddress =
                        $student
                            ->studentAddress()
                            ->create([
    
                                'student_province' =>
                                    $request->input(
                                        'student_province_name'
                                    ),
    
                                'student_regency' =>
                                    $request->input(
                                        'student_regency_name'
                                    ),
    
                                'student_district' =>
                                    $request->input(
                                        'student_district_name'
                                    ),
    
                                'student_village' =>
                                    $request->input(
                                        'student_village_name'
                                    ),
    
                                'address' =>
                                    $request->input(
                                        'address'
                                    ),
                            ]);
    
    
                    if (!$studentAddress) {
    
                        throw new Exception(
                            'Error creating student address.'
                        );
                    }
    
    
                    if (!$wali) {
    
                        throw new Exception(
                            'Error creating wali.'
                        );
                    }
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | STEP 7
                | CREATE INTERVIEW
                |--------------------------------------------------------------------------
                */
    
                $interview =
                    Interview::create([
    
                        'title' =>
                            $request->input(
                                'title'
                            ),
    
                        'interview_date' =>
                            $request->input(
                                'interview_date'
                            ),
    
                        'status' =>
                            'Dijadwalkan',
    
                        'method' =>
                            $request->input(
                                'method'
                            ),
    
                        'reason' =>
                            $request->input(
                                'reason'
                            ),
    
                        'user_id' =>
                            $user->id,
                    ]);
    
    
                if (!$interview) {
    
                    throw new Exception(
                        'Error creating interview.'
                    );
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | SAVE
                |--------------------------------------------------------------------------
                */
    
                $student->school_information_id =
                    $schoolInformation->id;
    
                $student->save();
    
    
                $interview->save();
    
    
                /*
                |--------------------------------------------------------------------------
                | RETURN DATA FROM TRANSACTION
                |--------------------------------------------------------------------------
                */
    
                return [
                    'student' => $student,
                    'user' => $user,
                ];
            });
    
    
            /*
            |--------------------------------------------------------------------------
            | TRANSACTION BERHASIL
            |--------------------------------------------------------------------------
            |
            | Pada titik ini semua data database sudah COMMIT.
            |
            */
    
            $student = $result['student'];
    
            $user = $result['user'];
    
    
            /*
            |--------------------------------------------------------------------------
            | SEND STUDENT CREDENTIAL
            |--------------------------------------------------------------------------
            */
    
            $this->sendStudentCredential(
                $student->id,
                $user->password
            );
    
    
            /*
            |--------------------------------------------------------------------------
            | SEND TELEGRAM
            |--------------------------------------------------------------------------
            */
    
            $this->sendTelegramNotification(
                $student
            );
    
    
            /*
            |--------------------------------------------------------------------------
            | SEND WHATSAPP
            |--------------------------------------------------------------------------
            */
    
            // $this->sendWhatsAppNotification(
            //     $student
            // );
    
    
            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */
    
            return view(
                'PPDB.success',
                compact('student')
            );
    
    
        } catch (Exception $e) {
    
            /*
            |--------------------------------------------------------------------------
            | DUPLICATE REGISTRATION
            |--------------------------------------------------------------------------
            */
    
            if (
                str_starts_with(
                    $e->getMessage(),
                    'DUPLICATE_REGISTRATION|'
                )
            ) {
    
                $uniqueCode =
                    explode(
                        '|',
                        $e->getMessage()
                    )[1];
    
                return redirect()
                    ->back()
                    ->withErrors([
                        'duplicate' =>
                            'Pendaftaran untuk siswa tersebut sudah pernah dilakukan. '
                            . 'Nomor pendaftaran: '
                            . $uniqueCode
                            . '. Silakan gunakan nomor pendaftaran tersebut dan jangan melakukan pendaftaran ulang.'
                    ])
                    ->withInput();
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | EMAIL SUDAH DIGUNAKAN
            |--------------------------------------------------------------------------
            */
    
            if (
                $e->getMessage() ===
                'EMAIL_ALREADY_USED'
            ) {
    
                return redirect()
                    ->back()
                    ->withErrors([
                        'email' =>
                            'Email sudah pernah digunakan.'
                    ])
                    ->withInput();
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | ERROR LAIN
            |--------------------------------------------------------------------------
            */
    
            Log::error(
                'PPDB registration failed.',
                [
                    'error' =>
                        $e->getMessage(),
    
                    'email' =>
                        $request->input(
                            'email'
                        ),
    
                    'fullname' =>
                        $request->input(
                            'fullname'
                        ),
                ]
            );
    
    
            return redirect()
                ->back()
                ->withErrors([
                    'registration' =>
                        'Pendaftaran gagal diproses. Silakan coba kembali.'
                ])
                ->withInput();
        }
    }
    
    //newregist
    public function newRegistrations()
    {
        $students = Student::with([
            'schoolInformation.educationLevel',
            'studentParent',
        ])
            ->where('whatsapp_notification_sent', false)
            ->orderBy('id')
            ->limit(20)
            ->get();
    
        return response()->json([
            'success' => true,
            'students' => $students->map(function ($student) {
                return [
                    'id' => $student->id,
                    'fullname' => $student->fullname,
                    'unique_code' => $student->unique_code,
    
                    'level' =>
                        $student->schoolInformation
                            ->educationLevel
                            ->level_name ?? '-',
    
                    'dad_phone' =>
                        $student->studentParent->dad_tel ?? null,
    
                    'mom_phone' =>
                        $student->studentParent->mom_tel ?? null,
    
                    'status' => $student->status_penerimaan,
    
                    'form_url' =>
                        route(
                            'print-formmulir-ppdb',
                            $student->unique_code
                        ),
                ];
            }),
        ]);
    }
    
    public function notificationSent(Student $student)
    {
        $student->whatsapp_notification_sent = 1;
        $student->save();
    
        return response()->json([
            'success' => true,
            'message' => 'WhatsApp notification marked as sent.',
        ]);
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
            $paymentUrl =
                \Midtrans\Snap::createTransaction($midtrans_params)
                    ->redirect_url;

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
        $notif = $request->method() == 'POST'
            ? new \Midtrans\Notification()
            : \Midtrans\Transaction::status($request->order_id);

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
        $student = Student::where(
            'unique_code',
            $uniqueCode
        )->firstOrFail();

        $student->status_penerimaan = 'Diterima';
        $student->save();

        return redirect()->back()->with(
            'success',
            'PPDB diterima'
        );
    }

    public function rejectPPDB(Request $request, $uniqueCode)
    {
        $student = Student::where(
            'unique_code',
            $uniqueCode
        )->firstOrFail();

        $student->status_penerimaan = 'Batal';
        $student->save();

        return redirect()->back()->with(
            'success',
            'Murid Telah Batal mendaftarkan diri / di batalkan oleh admin'
        );
    }

    public function sendStudentCredential($student_id, $password)
    {
        $student = Student::findOrFail($student_id);

        $interview = Interview::where(
            'user_id',
            $student->user_id
        )->first();

        Mail::to($student->email)->send(
            new PPDBRegistrationSuccess(
                $student,
                $password,
                $interview
            )
        );

        return redirect()->back()->with(
            'success',
            'Email kredensial telah dikirim ke student.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Telegram Notification
    |--------------------------------------------------------------------------
    */

    private function sendTelegramNotification($student)
    {
        $fullname = $student->fullname;

        $level =
            $student->schoolInformation
                ->educationLevel
                ->level_name;

        $createdAt =
            $student->created_at
                ->timezone('Asia/Jakarta');

        $dadTel =
            $student->studentParent->dad_tel ?? '-';

        $momTel =
            $student->studentParent->mom_tel ?? '-';

        $urlPrint =
            route(
                'print-formmulir-ppdb',
                $student->unique_code
            );

        $message =
            "*Notifikasi Pendaftaran PPDB*\n"
            . "👤 Nama: $fullname\n"
            . "📚 Unit: $level\n"
            . "🗓 Tanggal Daftar: "
            . $createdAt->format('d M Y')
            . "\n"
            . "📞 Telp Ayah: $dadTel\n"
            . "📞 Telp Ibu: $momTel\n"
            . "🖨 Formulir: [Klik untuk Cetak]($urlPrint)";

        $telegramToken = env('TELEGRAM_BOT_TOKEN');
        $chatIds = env('TELEGRAM_CHAT_IDS');

        if (!$telegramToken || !$chatIds) {
            Log::warning(
                'Telegram skipped: missing credentials.'
            );

            return;
        }

        try {

            $chatIdsArray = explode(',', $chatIds);

            foreach ($chatIdsArray as $chatId) {

                Http::post(
                    "https://api.telegram.org/bot{$telegramToken}/sendMessage",
                    [
                        'chat_id' => trim($chatId),
                        'text' => $message,
                        'parse_mode' => 'Markdown',
                        'disable_web_page_preview' => true
                    ]
                );

                usleep(300000);
            }

        } catch (Exception $e) {

            Log::error(
                'Telegram Error: ' . $e->getMessage()
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | WhatsApp Notification
    |--------------------------------------------------------------------------
    */

    private function sendWhatsAppNotification($student)
    {
        $fullname = $student->fullname;

        $level =
            $student->schoolInformation
                ->educationLevel
                ->level_name ?? '-';

        $uniqueCode = $student->unique_code;

        $dadTel =
            $student->studentParent->dad_tel ?? null;

        $momTel =
            $student->studentParent->mom_tel ?? null;

        $urlPrint =
            route(
                'print-formmulir-ppdb',
                $student->unique_code
            );

        $gatewayUrl =
            config('services.wa_gateway.url');

        $gatewayApiKey =
            config('services.wa_gateway.api_key');

        /*
        |--------------------------------------------------------------------------
        | Check Gateway Configuration
        |--------------------------------------------------------------------------
        */

        if (!$gatewayUrl || !$gatewayApiKey) {

            Log::warning(
                'PPDB WhatsApp skipped: Gateway configuration missing.',
                [
                    'student_id' => $student->id,
                ]
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Parent Message
        |--------------------------------------------------------------------------
        */

        $parentMessage =
            "*Pendaftaran PPDB Sekolah Yahya Berhasil*\n\n"
            . "👤 Nama Siswa: {$fullname}\n"
            . "📚 Unit: {$level}\n"
            . "🔖 No. Pendaftaran: {$uniqueCode}\n\n"
            . "Pendaftaran PPDB Anda telah berhasil dicatat "
            . "dan saat ini sedang menunggu proses selanjutnya.\n\n"
            . "🖨 *Formulir Pendaftaran:*\n"
            . "{$urlPrint}\n\n"
            . "Mohon simpan nomor pendaftaran tersebut "
            . "untuk keperluan proses PPDB.\n\n"
            . "Terima kasih.";

        /*
        |--------------------------------------------------------------------------
        | Parent Numbers
        |--------------------------------------------------------------------------
        */

        $parentNumbers = array_unique(
            array_filter([
                $this->normalizeWhatsAppNumber($dadTel),
                $this->normalizeWhatsAppNumber($momTel),
            ])
        );

        /*
        |--------------------------------------------------------------------------
        | Admin Numbers
        |--------------------------------------------------------------------------
        */

        $adminNumbers = array_unique(
            array_filter(
                array_map(
                    fn ($number) =>
                        $this->normalizeWhatsAppNumber($number),
                    explode(
                        ',',
                        config(
                            'services.ppdb.admin_whatsapp',
                            ''
                        )
                    )
                )
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Send To Parents
        |--------------------------------------------------------------------------
        */

        foreach ($parentNumbers as $number) {

            try {

                $response =
                    Http::timeout(10)
                        ->withHeaders([
                            'X-API-Key' => $gatewayApiKey,
                        ])
                        ->post(
                            rtrim($gatewayUrl, '/')
                            . '/api/send-message',
                            [
                                'number' => $number,
                                'message' => $parentMessage,
                            ]
                        );

                if ($response->successful()) {

                    Log::info(
                        'PPDB WhatsApp notification sent to parent.',
                        [
                            'student_id' => $student->id,
                            'unique_code' => $uniqueCode,
                            'number' => $number,
                        ]
                    );

                } else {

                    Log::error(
                        'PPDB WhatsApp Gateway returned error.',
                        [
                            'student_id' => $student->id,
                            'number' => $number,
                            'status' => $response->status(),
                            'response' => $response->body(),
                        ]
                    );
                }

            } catch (Exception $e) {

                Log::error(
                    'PPDB WhatsApp notification error.',
                    [
                        'student_id' => $student->id,
                        'number' => $number,
                        'error' => $e->getMessage(),
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Admin Message
        |--------------------------------------------------------------------------
        */

        $adminMessage =
            "*🔔 PENDAFTARAN PPDB BARU*\n\n"
            . "👤 *Nama Siswa:* {$fullname}\n"
            . "📚 *Unit:* {$level}\n"
            . "🔖 *No. Pendaftaran:* {$uniqueCode}\n"
            . "📅 *Tanggal:* "
            . now()
                ->timezone('Asia/Jakarta')
                ->format('d M Y H:i')
            . "\n\n"
            . "📞 *Telp Ayah:* "
            . ($dadTel ?? '-')
            . "\n"
            . "📞 *Telp Ibu:* "
            . ($momTel ?? '-')
            . "\n\n"
            . "🖨 *Formulir Pendaftaran:*\n"
            . "{$urlPrint}\n\n"
            . "⚠️ Status: *Menunggu Persetujuan*";

        /*
        |--------------------------------------------------------------------------
        | Send To All Admins
        |--------------------------------------------------------------------------
        */

        foreach ($adminNumbers as $adminNumber) {

            try {

                $response =
                    Http::timeout(10)
                        ->withHeaders([
                            'X-API-Key' => $gatewayApiKey,
                        ])
                        ->post(
                            rtrim($gatewayUrl, '/')
                            . '/api/send-message',
                            [
                                'number' => $adminNumber,
                                'message' => $adminMessage,
                            ]
                        );

                if ($response->successful()) {

                    Log::info(
                        'PPDB WhatsApp notification sent to admin.',
                        [
                            'student_id' => $student->id,
                            'unique_code' => $uniqueCode,
                            'admin_number' => $adminNumber,
                        ]
                    );

                } else {

                    Log::error(
                        'PPDB WhatsApp admin notification failed.',
                        [
                            'student_id' => $student->id,
                            'admin_number' => $adminNumber,
                            'status' => $response->status(),
                            'response' => $response->body(),
                        ]
                    );
                }

            } catch (Exception $e) {

                Log::error(
                    'PPDB WhatsApp admin notification error.',
                    [
                        'student_id' => $student->id,
                        'admin_number' => $adminNumber,
                        'error' => $e->getMessage(),
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | No Admin Number
        |--------------------------------------------------------------------------
        */

        if (empty($adminNumbers)) {

            Log::warning(
                'PPDB WhatsApp admin notification skipped: admin numbers missing.',
                [
                    'student_id' => $student->id,
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Normalize WhatsApp Number
    |--------------------------------------------------------------------------
    */

    private function normalizeWhatsAppNumber($number)
    {
        if (!$number) {
            return null;
        }

        $number = preg_replace(
            '/[^0-9]/',
            '',
            $number
        );

        if (!$number) {
            return null;
        }

        // 08xxxxxxxxxx → 628xxxxxxxxxx
        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }

        // 62xxxxxxxxxx → tetap
        if (str_starts_with($number, '62')) {
            return $number;
        }

        return null;
    }

    public function print($uniqueCode)
    {
        $student =
            Student::where(
                'unique_code',
                $uniqueCode
            )->firstOrFail();

        return view(
            'print-formulir',
            compact('student')
        );
    }
}