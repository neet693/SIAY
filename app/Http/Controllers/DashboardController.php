<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $parents = StudentParent::all();
        return view('Dashboard.index', compact('students', 'parents'));
    }
}
