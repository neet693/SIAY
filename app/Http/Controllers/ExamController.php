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
        return view('Exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role_id', 2)->get();
        return view('Exams.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'teacher_id' => 'required',
            'duration' => 'required|integer',
            'schedule_at' => 'required|date',
        ]);

        // Create a new exam instance
        $exam = new Exam();

        // Set the exam properties
        $exam->title = $request->title;
        $exam->description = $request->description;
        $exam->teacher_id = $request->teacher_id;
        $exam->duration = $request->duration;
        $exam->schedule_at = $request->schedule_at;

        // Save the exam to the database
        $exam->save();

        // Redirect to the exam index page
        return redirect()->route('admin.exam.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        return view('exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('exam.index')->with('success', 'Exam deleted successfully.');
    }
}
