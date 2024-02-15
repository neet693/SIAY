<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::with('user')->get();
        return view('Interviews.index', compact('interviews'));
    }

    public function create()
    {
        $users = User::all();
        return view('Interviews.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'interview_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'method' => 'required',
            'status' => 'required',
            'reason' => 'required',
            'user_id' => 'required',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['status'] = 'Dijadwalkan';

        Interview::create($validatedData);
        if (Auth::user()->role_id = Role::IS_STUDENT) {
            // Redirect to the student dashboard instead of interviews.index
            return redirect()->route('student.dashboard')->with('success', 'Interview created successfully.');
        } else {
            // If the user is not a student, redirect to interviews.index as before
            return redirect()->route('interviews.index')->with('success', 'Interview created successfully.');
        }
        // return redirect()->route('interviews.index')->with('success', 'Interview created successfully.');
    }


    public function show(Interview $interview)
    {
        return view('Interviews.show', compact('interview'));
    }

    public function edit(Interview $interview)
    {
        $users = User::all();
        return view('Interviews.edit', compact('interview', 'users'));
    }

    public function update(Request $request, Interview $interview)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'interview_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'method' => 'required',
            'status' => 'required',
            'user_id' => 'required',
        ]);

        $interview->update($validatedData);
        return redirect()->route('interviews.index')->with('success', 'Interview updated successfully');
    }

    public function destroy(Interview $interview)
    {
        $interview->delete();
        return redirect()->route('interviews.index')->with('success', 'Interview deleted successfully');
    }
}
