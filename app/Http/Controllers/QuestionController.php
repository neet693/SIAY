<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validasi input
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'question_text' => 'required',
            'question_type' => 'required|in:multiple_choice,true_false,short_answer,essay',
            'options' => 'array|required_if:question_type,multiple_choice',
            'options.*.option_text' => 'required_if:question_type,multiple_choice',
            'options.*.is_correct' => 'boolean|required_if:question_type,multiple_choice'
        ]);

        // Buat pertanyaan baru
        $question = Question::create($request->only(['exam_id', 'question_text', 'question_type']));

        // Tambahkan opsi jika ada (untuk pertanyaan pilihan ganda)
        if ($request->has('options')) {
            $options = [];
            foreach ($request->options as $option) {
                $options[] = new Option([
                    'option_text' => $option['option_text'],
                    'is_correct' => $option['is_correct']
                ]);
            }
            $question->options()->saveMany($options);
        }

        return redirect()->back()->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
