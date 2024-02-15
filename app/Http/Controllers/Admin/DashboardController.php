<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $parents = StudentParent::all();
        $transactions = Transaction::all();
        $PPDBPaid = Transaction::where('transaction_type_id', 1)
            ->where('payment_status', 'paid')
            ->sum('price');

        $PPDBUnpaid = Transaction::where('transaction_type_id', 1)
            ->where('payment_status', 'pending')
            ->sum('price');

        return view('Admin.Dashboard.index', compact(
            'students',
            'parents',
            'PPDBPaid',
            'PPDBUnpaid',
            'transactions'

        ));
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
    public function show(string $id)
    {
        //
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
