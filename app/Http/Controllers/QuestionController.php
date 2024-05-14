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
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'question_text' => 'required',
            'question_type' => 'required|in:multiple_choice,true_false,short_answer,essay',

        ]);

        // Simpan pertanyaan
        $question = new Question([
            'exam_id' => $request->input('exam_id'),
            'question_text' => $request->input('question_text'),
            'question_type' => $request->input('question_type')
        ]);
        $question->save();

        // Jika tipe pertanyaan adalah multiple choice, simpan pilihan jawaban
        if ($request->input('question_type') === 'multiple_choice') {
            $request->validate([
                'options.*.option_text' => 'required_if:question_type,multiple_choice',
                'options.*.is_correct' => 'boolean' // Opsional: Validasi untuk is_correct
            ]);
            foreach ($request->input('options') as $optionData) {
                $option = new Option([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => isset($optionData['is_correct']) ? (bool)$optionData['is_correct'] : false
                ]);
                $question->options()->save($option);
            }
        }

        return redirect()->back()->with('success', 'Question added successfully.');
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
