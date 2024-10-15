<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Interview;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $interview = Interview::where('user_id', $user->id)->first();

        // Ambil ujian yang ditugaskan untuk siswa
        $assignedExams = $user->assignedExams()->with(['exam', 'scores'])->get();

        // Tambahkan skor ke setiap ujian yang ditugaskan
        foreach ($assignedExams as $assignedExam) {
            // Pastikan scores tidak null sebelum memanggil firstWhere
            $assignedExam->studentScore = $assignedExam->scores ?
                $assignedExam->scores->firstWhere('student_id', $user->student->id) : null;
        }

        return view('Student.dashboard', compact('interview', 'assignedExams'));
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
    public function show($unique_code)
    {
        $student = Student::where('unique_code', $unique_code)->firstOrFail();
        // Mendapatkan data student parent beserta alamatnya
        $studentParent = $student->studentParent()->with('studentParentAddress')->first();

        $paidTransactions = $student->transactions()
            ->where('payment_status', 'paid')
            ->get();

        $transactions = $student->transactions();

        // Mendapatkan nama-nama transaksi yang sudah dibayar oleh student
        $paidTransactionNames = $paidTransactions->pluck('transactionType.name')
            ->implode(', ');

        return view('Student.show', compact('student', 'studentParent', 'paidTransactionNames', 'transactions'));
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

    public function updateParent(Request $request, $unique_code)
    {
        $student = Student::where('unique_code', $unique_code)->firstOrFail();

        // Validasi input
        $request->validate([
            'dad_name' => 'required|string|max:255',
            'dad_degree' => 'nullable|string|max:255',
            'dad_job' => 'nullable|string|max:255',
            'dad_tel' => 'nullable|string|max:255',
            'mom_name' => 'required|string|max:255',
            'mom_degree' => 'nullable|string|max:255',
            'mom_job' => 'nullable|string|max:255',
            'mom_tel' => 'nullable|string|max:255',
            'parent_province' => 'required',
            'parent_regency' => 'required',
            'parent_district' => 'required',
            'parent_village' => 'required',
            'address' => 'required',
        ]);

        // Simpan data orang tua
        $student->studentParent()->update([
            'dad_name' => $request->dad_name,
            'dad_degree' => $request->dad_degree,
            'dad_job' => $request->dad_job,
            'dad_tel' => $request->dad_tel,
            'mom_name' => $request->mom_name,
            'mom_degree' => $request->mom_degree,
            'mom_job' => $request->mom_job,
            'mom_tel' => $request->mom_tel,
        ]);

        $studentParent = $student->studentParent()->with('studentParentAddress')->first();

        // Simpan data alamat orang tua
        $studentParent->studentParentAddress->update([
            'parent_province' => $request->parent_province,
            'parent_regency' => $request->parent_regency,
            'parent_district' => $request->parent_district,
            'parent_village' => $request->parent_village,
            'address' => $request->address,
        ]);

        if ($student->residence_status_id == 1) {
            $studentParentAddress = $studentParent->studentParentAddress->first();
            $student->studentAddress()->update([
                'student_province' => $studentParentAddress->parent_province,
                'student_regency' => $studentParentAddress->parent_regency,
                'student_district' => $studentParentAddress->parent_district,
                'student_village' => $studentParentAddress->parent_village,
                'address' => $studentParentAddress->address,
            ]);
        }

        return redirect()->back();
    }

    public function takeExam(Exam $exam)
    {
        $questions = $exam->questions;

        return view('Student.takeExam', compact('exam', 'questions'));
    }
}
