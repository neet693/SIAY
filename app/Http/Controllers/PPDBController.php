<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePPDBRequest;
use App\Mail\PPDBRegistrationSuccess;
use App\Models\AcademicYear;
use App\Models\Interview;
use App\Models\SchoolInformation;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wali;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Midtrans\Config;

class PPDBController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    public function index()
    {
        $students = Student::where('status_penerimaan', 'Diterima')->get();

        return view('welcome', compact('students'));
    }

    public function create()
    {
        $academicYears = AcademicYear::where('is_active', true)->get();

        return view('PPDB.create', compact('academicYears'));
    }

    public function store(StorePPDBRequest $request)
    {
        // StorePPDBRequest sudah memvalidasi request sebelum method ini berjalan.
        $data = array_merge(
            $request->validated(),
            $request->only([
                'reason',
                'wali_name',
                'wali_degree',
                'wali_job',
                'wali_address',
                'wali_tel',
                'student_province_name',
                'student_regency_name',
                'student_district_name',
                'student_village_name',
            ])
        );

        $fullname = trim($data['fullname']);
        $birthDate = $data['birth_date'];
        $academicYearId = $data['academic_year_id'];
        $educationLevelId = $data['education_level_id'];

        $dadTel = preg_replace('/[^0-9]/', '', $data['dad_tel']);
        $momTel = preg_replace('/[^0-9]/', '', $data['mom_tel']);

        try {
            $result = DB::transaction(function () use (
                $data,
                $fullname,
                $birthDate,
                $academicYearId,
                $educationLevelId,
                $dadTel,
                $momTel
            ) {
                $academicYearRecord = AcademicYear::where('id', $academicYearId)
                    ->lockForUpdate()
                    ->first();

                if (!$academicYearRecord) {
                    throw new Exception('Tahun ajaran tidak ditemukan.');
                }

                $duplicateStudent = Student::whereRaw(
                    'LOWER(TRIM(fullname)) = ?',
                    [mb_strtolower($fullname)]
                )
                    ->whereDate('birth_date', $birthDate)
                    ->whereHas('schoolInformation', function ($query) use ($academicYearId, $educationLevelId) {
                        $query->where('academic_year_id', $academicYearId)
                            ->where('education_level_id', $educationLevelId);
                    })
                    ->whereHas('studentParent', function ($query) use ($dadTel, $momTel) {
                        $query->where(function ($q) use ($dadTel, $momTel) {
                            $q->where('dad_tel', $dadTel)
                                ->orWhere('mom_tel', $momTel)
                                ->orWhere('dad_tel', $momTel)
                                ->orWhere('mom_tel', $dadTel);
                        });
                    })
                    ->first();

                if ($duplicateStudent) {
                    throw new Exception('DUPLICATE_REGISTRATION|' . $duplicateStudent->unique_code);
                }

                $email = trim($data['email']);

                if (User::where('email', $email)->exists()) {
                    throw new Exception('EMAIL_ALREADY_USED');
                }

                $schoolInformation = SchoolInformation::create([
                    'academic_year_id' => $academicYearId,
                    'education_level_id' => $educationLevelId,
                    'news_from' => $data['news_from'],
                    'last_school' => $data['last_school'],
                ]);

                $plainPassword = 'sekolahyahya*';

                $user = User::create([
                    'name' => $fullname,
                    'email' => $email,
                    'role_id' => 3,
                    'password' => bcrypt($plainPassword),
                ]);

                $yearName = (string) $schoolInformation->academicYear->name;
                $academicYearCode = substr($yearName, 2, 2) . substr($yearName, -2, 2);
                $uniqueCode = $schoolInformation->educationLevel->level_name
                    . '-' . $academicYearCode
                    . '-' . sprintf('%04d', $schoolInformation->id);

                $student = Student::create([
                    'user_id' => $user->id,
                    'school_information_id' => $schoolInformation->id,
                    'unique_code' => $uniqueCode,
                    'fullname' => $fullname,
                    'nickname' => $data['nickname'],
                    'citizenship' => $data['citizenship'],
                    'gender' => $data['gender'],
                    'birth_place' => $data['birth_place'],
                    'birth_date' => $birthDate,
                    'religion_id' => $data['religion_id'],
                    'church_domicile' => $data['church_domicile'],
                    'child_position' => $data['child_position'],
                    'child_number' => $data['child_number'],
                    'blood_type_id' => $data['blood_type_id'],
                    'email' => $email,
                    'residence_status_id' => $data['residence_status_id'],
                    'status_penerimaan' => 'Menunggu Persetujuan',
                ]);

                $studentParent = StudentParent::create([
                    'student_id' => $student->id,
                    'dad_name' => $data['dad_name'],
                    'mom_name' => $data['mom_name'],
                    'dad_degree' => $data['dad_degree'],
                    'mom_degree' => $data['mom_degree'],
                    'dad_job' => $data['dad_job'],
                    'mom_job' => $data['mom_job'],
                    'dad_tel' => $data['dad_tel'],
                    'mom_tel' => $data['mom_tel'],
                ]);

                $studentParentAddress = $studentParent->studentParentAddress()->create([
                    'parent_province' => $data['parent_province'],
                    'parent_regency' => $data['parent_regency'],
                    'parent_district' => $data['parent_district'],
                    'parent_village' => $data['parent_village'],
                    'address' => $data['address'],
                    'parentStay' => $data['parentStay'],
                ]);

                if ((string) $data['residence_status_id'] === '1') {
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
                        'wali_name' => $data['wali_name'] ?? null,
                        'wali_degree' => $data['wali_degree'] ?? null,
                        'wali_job' => $data['wali_job'] ?? null,
                        'wali_address' => $data['wali_address'] ?? null,
                        'wali_tel' => $data['wali_tel'] ?? null,
                    ]);

                    $student->studentAddress()->create([
                        'student_province' => $data['student_province_name'] ?? null,
                        'student_regency' => $data['student_regency_name'] ?? null,
                        'student_district' => $data['student_district_name'] ?? null,
                        'student_village' => $data['student_village_name'] ?? null,
                        // The existing form/controller uses "address" for both addresses.
                        // Confirm the Blade field names before changing this mapping.
                        'address' => $data['address'],
                    ]);
                }

                $interview = Interview::create([
                    'title' => $data['title'],
                    'interview_date' => $data['interview_date'],
                    'status' => 'Dijadwalkan',
                    'method' => $data['method'],
                    'reason' => $data['reason'] ?? null,
                    'user_id' => $user->id,
                ]);

                return [
                    'student' => $student,
                    'user' => $user,
                    'plain_password' => $plainPassword,
                ];
            });

        } catch (Exception $e) {
            if (str_starts_with($e->getMessage(), 'DUPLICATE_REGISTRATION|')) {
                $uniqueCode = explode('|', $e->getMessage(), 2)[1];

                return redirect()->back()->withErrors([
                    'duplicate' => 'Pendaftaran untuk siswa tersebut sudah pernah dilakukan. Nomor pendaftaran: '
                        . $uniqueCode
                        . '. Silakan gunakan nomor pendaftaran tersebut dan jangan melakukan pendaftaran ulang.',
                ])->withInput();
            }

            if ($e->getMessage() === 'EMAIL_ALREADY_USED') {
                return redirect()->back()->withErrors([
                    'email' => 'Email sudah pernah digunakan.',
                ])->withInput();
            }

            Log::error('PPDB registration failed.', [
                'error' => $e->getMessage(),
                'email' => $request->input('email'),
                'fullname' => $request->input('fullname'),
            ]);

            return redirect()->back()->withErrors([
                'registration' => 'Pendaftaran gagal diproses. Silakan coba kembali.',
            ])->withInput();
        }

        // Database sudah commit. Kegagalan notifikasi tidak boleh membatalkan status pendaftaran.
        $student = $result['student'];

        try {
            $this->sendStudentCredential($student->id, $result['plain_password']);
        } catch (Exception $e) {
            Log::error('PPDB credential email failed after registration commit.', [
                'student_id' => $student->id,
                'error' => $e->getMessage(),
            ]);
        }

        try {
            $this->sendTelegramNotification($student);
        } catch (Exception $e) {
            Log::error('PPDB Telegram notification failed after registration commit.', [
                'student_id' => $student->id,
                'error' => $e->getMessage(),
            ]);
        }

        // WhatsApp masih nonaktif sesuai perilaku controller sebelumnya.
        // $this->sendWhatsAppNotification($student);

        return view('PPDB.success', compact('student'));
    }

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
                    'level' => $student->schoolInformation->educationLevel->level_name ?? '-',
                    'dad_phone' => $student->studentParent->dad_tel ?? null,
                    'mom_phone' => $student->studentParent->mom_tel ?? null,
                    'status' => $student->status_penerimaan,
                    'form_url' => route('print-formmulir-ppdb', $student->unique_code),
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

        $itemDetails = [[
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Pembayaran PPDB {$transaction->student->fullname}",
        ]];

        $userData = [
            'first_name' => $transaction->student->fullname,
            'last_name' => '',
            'postal_code' => '',
            'address' => optional($transaction->student->studentAddress)->address ?? '',
            'email' => $transaction->student->email,
            'country_code' => 'IDN',
        ];

        $midtransParams = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $price,
            ],
            'customer_details' => [
                'first_name' => $transaction->student->fullname,
                'last_name' => '',
                'email' => $transaction->student->email,
                'billing_address' => $userData,
                'shipping_address' => $userData,
            ],
            'item_details' => $itemDetails,
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;
            $transaction->midtrans_url = $paymentUrl;
            $transaction->save();

            return redirect(route('welcome'));
        } catch (Exception $e) {
            Log::error('Midtrans transaction creation failed.', [
                'transaction_id' => $transaction->id,
                'error' => $e->getMessage(),
            ]);

            return redirect(route('welcome'))->withErrors([
                'payment' => 'Pembayaran belum dapat diproses. Silakan coba kembali.',
            ]);
        }
    }

    public function callback(Request $request)
    {
        try {
            $notif = $request->method() === 'POST'
                ? new \Midtrans\Notification()
                : \Midtrans\Transaction::status($request->order_id);

            $orderIdParts = explode('-', $notif->order_id);
            $transaction = Transaction::find($orderIdParts[0] ?? null);

            if (!$transaction) {
                Log::warning('Midtrans callback transaction not found.', [
                    'order_id' => $notif->order_id ?? null,
                ]);

                return response()->json(['message' => 'Transaction not found.'], 404);
            }

            $transactionStatus = $notif->transaction_status;
            $fraud = $notif->fraud_status ?? null;

            if ($transactionStatus === 'capture') {
                $transaction->payment_status = $fraud === 'challenge' ? 'pending' : 'paid';
            } elseif ($transactionStatus === 'settlement') {
                $transaction->payment_status = 'paid';
            } elseif ($transactionStatus === 'pending') {
                $transaction->payment_status = 'pending';
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'], true)) {
                $transaction->payment_status = 'failed';
            }

            $transaction->save();

            return redirect(route('welcome'));
        } catch (Exception $e) {
            Log::error('Midtrans callback failed.', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Callback processing failed.'], 500);
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
        $interview = Interview::where('user_id', $student->user_id)->first();

        Mail::to($student->email)->send(
            new PPDBRegistrationSuccess($student, $password, $interview)
        );

        return redirect()->back()->with('success', 'Email kredensial telah dikirim ke student.');
    }

    private function sendTelegramNotification($student)
    {
        $fullname = $student->fullname;
        $level = $student->schoolInformation->educationLevel->level_name ?? '-';
        $createdAt = $student->created_at
            ? $student->created_at->timezone('Asia/Jakarta')
            : now()->timezone('Asia/Jakarta');

        $dadTel = $student->studentParent->dad_tel ?? '-';
        $momTel = $student->studentParent->mom_tel ?? '-';
        $urlPrint = route('print-formmulir-ppdb', $student->unique_code);

        $message = "*Notifikasi Pendaftaran PPDB*\n"
            . "👤 Nama: {$fullname}\n"
            . "📚 Unit: {$level}\n"
            . "🗓 Tanggal Daftar: " . $createdAt->format('d M Y') . "\n"
            . "📞 Telp Ayah: {$dadTel}\n"
            . "📞 Telp Ibu: {$momTel}\n"
            . "🖨 Formulir: [Klik untuk Cetak]({$urlPrint})";

        $telegramToken = config('services.telegram.bot_token', env('TELEGRAM_BOT_TOKEN'));
        $chatIds = config('services.telegram.chat_ids', env('TELEGRAM_CHAT_IDS'));

        if (!$telegramToken || !$chatIds) {
            Log::warning('Telegram skipped: missing credentials.');
            return;
        }

        foreach (explode(',', $chatIds) as $chatId) {
            try {
                $response = Http::timeout(10)->post(
                    "https://api.telegram.org/bot{$telegramToken}/sendMessage",
                    [
                        'chat_id' => trim($chatId),
                        'text' => $message,
                        'parse_mode' => 'Markdown',
                        'disable_web_page_preview' => true,
                    ]
                );

                if (!$response->successful()) {
                    Log::error('Telegram API returned an error.', [
                        'status' => $response->status(),
                        'response' => $response->body(),
                    ]);
                }
            } catch (Exception $e) {
                Log::error('Telegram Error: ' . $e->getMessage());
            }

            usleep(300000);
        }
    }

    private function sendWhatsAppNotification($student)
    {
        $fullname = $student->fullname;
        $level = $student->schoolInformation->educationLevel->level_name ?? '-';
        $uniqueCode = $student->unique_code;
        $dadTel = $student->studentParent->dad_tel ?? null;
        $momTel = $student->studentParent->mom_tel ?? null;
        $urlPrint = route('print-formmulir-ppdb', $student->unique_code);

        $gatewayUrl = config('services.wa_gateway.url');
        $gatewayApiKey = config('services.wa_gateway.api_key');

        if (!$gatewayUrl || !$gatewayApiKey) {
            Log::warning('PPDB WhatsApp skipped: Gateway configuration missing.', [
                'student_id' => $student->id,
            ]);
            return;
        }

        $parentMessage = "*Pendaftaran PPDB Sekolah Yahya Berhasil*\n\n"
            . "👤 Nama Siswa: {$fullname}\n"
            . "📚 Unit: {$level}\n"
            . "🔖 No. Pendaftaran: {$uniqueCode}\n\n"
            . "Pendaftaran PPDB Anda telah berhasil dicatat dan saat ini sedang menunggu proses selanjutnya.\n\n"
            . "🖨 *Formulir Pendaftaran:*\n{$urlPrint}\n\n"
            . "Mohon simpan nomor pendaftaran tersebut untuk keperluan proses PPDB.\n\nTerima kasih.";

        $parentNumbers = array_unique(array_filter([
            $this->normalizeWhatsAppNumber($dadTel),
            $this->normalizeWhatsAppNumber($momTel),
        ]));

        $adminNumbers = array_unique(array_filter(array_map(
            fn ($number) => $this->normalizeWhatsAppNumber($number),
            explode(',', config('services.ppdb.admin_whatsapp', ''))
        )));

        foreach ($parentNumbers as $number) {
            $this->sendWhatsAppMessage($gatewayUrl, $gatewayApiKey, $number, $parentMessage, $student->id, 'parent');
        }

        $adminMessage = "*🔔 PENDAFTARAN PPDB BARU*\n\n"
            . "👤 *Nama Siswa:* {$fullname}\n"
            . "📚 *Unit:* {$level}\n"
            . "🔖 *No. Pendaftaran:* {$uniqueCode}\n"
            . "📅 *Tanggal:* " . now()->timezone('Asia/Jakarta')->format('d M Y H:i') . "\n\n"
            . "📞 *Telp Ayah:* " . ($dadTel ?? '-') . "\n"
            . "📞 *Telp Ibu:* " . ($momTel ?? '-') . "\n\n"
            . "🖨 *Formulir Pendaftaran:*\n{$urlPrint}\n\n"
            . "⚠️ Status: *Menunggu Persetujuan*";

        foreach ($adminNumbers as $adminNumber) {
            $this->sendWhatsAppMessage($gatewayUrl, $gatewayApiKey, $adminNumber, $adminMessage, $student->id, 'admin');
        }

        if (empty($adminNumbers)) {
            Log::warning('PPDB WhatsApp admin notification skipped: admin numbers missing.', [
                'student_id' => $student->id,
            ]);
        }
    }

    private function sendWhatsAppMessage($gatewayUrl, $apiKey, $number, $message, $studentId, $recipientType)
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders(['X-API-Key' => $apiKey])
                ->post(rtrim($gatewayUrl, '/') . '/api/send-message', [
                    'number' => $number,
                    'message' => $message,
                ]);

            if ($response->successful()) {
                Log::info("PPDB WhatsApp notification sent to {$recipientType}.", [
                    'student_id' => $studentId,
                    'number' => $number,
                ]);
            } else {
                Log::error("PPDB WhatsApp notification failed for {$recipientType}.", [
                    'student_id' => $studentId,
                    'number' => $number,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }
        } catch (Exception $e) {
            Log::error("PPDB WhatsApp notification error for {$recipientType}.", [
                'student_id' => $studentId,
                'number' => $number,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function normalizeWhatsAppNumber($number)
    {
        if (!$number) {
            return null;
        }

        $number = preg_replace('/[^0-9]/', '', $number);

        if (!$number) {
            return null;
        }

        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }

        if (str_starts_with($number, '62')) {
            return $number;
        }

        return null;
    }

    public function print($uniqueCode)
    {
        $student = Student::where('unique_code', $uniqueCode)->firstOrFail();

        return view('print-formulir', compact('student'));
    }
}
