<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $transactions =  Transaction::all();
        $students = Student::all();
        $parents = StudentParent::all();
        return view('Admin.Student.index', compact('students', 'parents', 'transactions'));
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

        // Mendapatkan nama-nama transaksi yang sudah dibayar oleh student
        $paidTransactionNames = $paidTransactions->pluck('transactionType.name')
            ->implode(', ');

        return view('Admin.Student.show', compact('student', 'studentParent', 'paidTransactionNames'));
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
}
