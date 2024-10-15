<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Score;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all()->map(function ($exam) {
            $startDate = Carbon::parse($exam->start_date);
            $endDate = Carbon::parse($exam->end_date);
            $exam->interval = $startDate->diffForHumans($endDate, true); // Menyimpan interval ke objek exam
            return $exam;
        });
        return view('Exams.index', compact('exams'));
    }

    public function create()
    {
        $teachers = User::where('role_id', 2)->get();
        return view('exams.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'teacher_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $exam = Exam::create($request->all());

        return redirect()->route('admin.exam.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        // Load questions relationship
        $exam->load('questions');

        // Menghitung interval antara start_date dan end_date
        $startDate = Carbon::parse($exam->start_date);
        $endDate = Carbon::parse($exam->end_date);
        $exam->interval = $startDate->diffForHumans($endDate, true); // Menyimpan interval

        // Ambil data siswa
        $students = User::where('role_id', 3)->get();

        // Ambil siswa yang ditugaskan pada ujian ini
        $assignedStudents = $exam->assignedStudents;

        return view('exams.show', compact('exam', 'students', 'assignedStudents'));
    }

    public function edit(Exam $exam)
    {
        $teachers = User::where('role_id', 2)->get();
        return view('exams.edit', compact('exam', 'teachers'));
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'teacher_id' => 'required',
            'duration' => 'required|integer',
            'schedule_at' => 'required|date',
        ]);

        $exam->update($request->all());

        return redirect()->route('admin.exam.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->questions()->delete();
        $exam->delete();
        return redirect()->route('admin.exam.index')->with('success', 'Exam deleted successfully.');
    }

    public function assignExam(Request $request, Exam $exam)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:students,user_id',
        ]);

        // Ambil user_id siswa yang dipilih dari request
        $userIds = $request->input('students', []);

        // Dapatkan student_id berdasarkan user_id yang sesuai
        $students = Student::whereIn('user_id', $userIds)->pluck('id');

        // Menugaskan ujian kepada siswa dengan menggunakan metode syncWithoutDetaching
        $exam->assignedStudents()->syncWithoutDetaching($students);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.exam.show', $exam)->with('success', 'Exam assigned to students successfully.');
    }
}
