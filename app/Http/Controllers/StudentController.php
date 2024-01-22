<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $parents = StudentParent::all();
        return view('Student.student_index', compact('students', 'parents'));
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
    // public function show(Student $student)
    // {
    //     $studentParent = $student->studentParent->where('student_id', $student->id);
    //     return view('Student.student_show', compact('student', 'studentParent'));
    // }

    public function show(Student $student)
    {
        // Mendapatkan data student parent beserta alamatnya
        $studentParent = $student->studentParent()->with('studentParentAddress')->first();
        $paidTransaction = Transaction::where('student_id', $student->id)
            ->where('is_success', true)
            ->get();
        return view('Student.student_show', compact('student', 'studentParent', 'paidTransaction'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
