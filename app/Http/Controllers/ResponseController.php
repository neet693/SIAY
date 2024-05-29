<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Option;
use App\Models\Response;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResponseController extends Controller
{
    public function store(Request $request, Exam $exam)
{
    // Validasi data yang diterima dari formulir
    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required', // Pastikan semua jawaban diisi
    ]);

    // Dapatkan ID siswa berdasarkan pengguna yang sedang masuk
    $studentId = auth()->user()->student->id;

    // Simpan jawaban ke dalam tabel responses
    foreach ($request->answers as $questionId => $answer) {
        Response::create([
            'student_id' => $studentId,
            'exam_id' => $exam->id,
            'question_id' => $questionId,
            'option_id' => $answer,
            'response_text' => $answer, // Pastikan ini adalah teks jawaban atau ID yang diinginkan
        ]);
    }

    // Lakukan evaluasi ujian
    $this->evaluateExam($exam, $studentId);

    // Redirect kembali dengan pesan sukses
    return redirect()->route('student.dashboard')->with('success', 'Exam submitted successfully.');
}




    public function evaluateExam(Exam $exam, $studentId)
    {
        // Ambil jawaban siswa untuk ujian tertentu
        $studentResponses = Response::where('student_id', $studentId)
            ->whereIn('question_id', $exam->questions()->pluck('id'))
            ->pluck('option_id', 'question_id');

        // Hitung skor
        $score = 0;
        $totalQuestions = $exam->questions->count(); // Jumlah total pertanyaan

        foreach ($exam->questions as $question) {
            if ($question->question_type === 'multiple_choice' || $question->question_type === 'pilihan_ganda') {
                // Ambil opsi jawaban yang benar dari model Option
                $correctOption = Option::where('question_id', $question->id)
                    ->where('is_correct', true)
                    ->first();

                // Bandingkan jawaban siswa dengan jawaban yang benar
                if ($studentResponses->get($question->id) == $correctOption->id) {
                    $score++;
                }
            } else {
                // Tambahan logika untuk jenis pertanyaan lainnya (jika ada)
            }
        }

        // Jika semua jawaban benar, atur skor menjadi 100
        if ($totalQuestions > 0) {
            $score = ($score / $totalQuestions) * 100;
        }

        // Simpan atau perbarui skor di dalam tabel Score
        Score::updateOrCreate(
            ['exam_id' => $exam->id, 'student_id' => $studentId],
            ['mark' => $score]
        );

        // Kembalikan nilai skor untuk digunakan dalam tampilan tabel
        return $score;
    }
}
