<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
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
            'duration' => 'required|integer',
            'schedule_at' => 'required|date',
        ]);

        $exam = Exam::create($request->all());

        return redirect()->route('admin.exam.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        $exam->load('questions');
        return view('exams.show', compact('exam'));
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
        $exam->delete();
        return redirect()->route('admin.exam.index')->with('success', 'Exam deleted successfully.');
    }
}
