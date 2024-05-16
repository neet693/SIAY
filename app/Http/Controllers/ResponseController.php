<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Option;
use App\Models\Response;
use App\Models\Score;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request, Exam $exam)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'answers.*' => 'required', // Sesuaikan dengan aturan validasi yang diperlukan
        ]);

        // Simpan jawaban ke dalam tabel responses
        foreach ($request->answers as $questionId => $answer) {
            Response::create([
                'user_id' => auth()->id(),
                'exam_id' => $exam->id,
                'question_id' => $questionId,
                'response_text' => $answer,
            ]);
        }


        // Lakukan evaluasi ujian
        $this->evaluateExam($exam, auth()->id());

        // Redirect kembali dengan pesan sukses
        return redirect()->route('student.dashboard')->with('success', 'Exam submitted successfully.');
    }


    public function evaluateExam(Exam $exam, $studentId)
    {
        // Ambil jawaban siswa untuk ujian tertentu
        $studentResponses = Response::where('user_id', $studentId)
            ->whereIn('question_id', $exam->questions->pluck('id'))
            ->pluck('response_text', 'question_id');

        // Hitung skor
        $score = 0;
        $totalQuestions = $exam->questions->count(); // Jumlah total pertanyaan

        foreach ($exam->questions as $question) {
            if ($question->question_type === 'multiple_choice') {
                // Ambil opsi jawaban yang benar dari model Option
                $correctOption = Option::where('question_id', $question->id)
                    ->where('is_correct', true)
                    ->first();

                // Bandingkan jawaban siswa dengan jawaban yang benar (jika ada)
                if ($correctOption && $studentResponses->get($question->id) === $correctOption->option_text) {
                    $score++;
                }
            } else {
                // Tambahan logika untuk jenis pertanyaan lainnya (jika ada)
            }
        }

        // Jika semua jawaban benar, atur skor menjadi 100
        if ($score === $totalQuestions) {
            $score = 100;
        }

        // Simpan skor ke dalam tabel Score
        Score::create([
            'exam_id' => $exam->id,
            'user_id' => $studentId,
            'score' => $score,
        ]);

        // Kembalikan nilai skor untuk digunakan dalam tampilan tabel
        return $score;
    }
}
