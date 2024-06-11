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
        $acceptedInterview = Interview::where('status', 'Selesai')->count();
        return view('Interviews.index', compact('interviews', 'acceptedInterview'));
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
            'method' => 'required',
            'reason' => 'required_if:method,online,offline',
            'user_id' => 'required',
        ]);

        // Check for duplicate entry
        $existingInterview = Interview::where('title', $validatedData['title'])
            ->where('interview_date', $validatedData['interview_date'])
            ->where('method', $validatedData['method'])
            ->where('reason', $validatedData['reason'])
            ->where('user_id', $validatedData['user_id'])
            ->exists();

        // If duplicate entry exists, return error message
        if ($existingInterview) {
            return redirect()->back()->withErrors('Data interview sudah ada.')->withInput();
        }

        // Set default status
        $validatedData['status'] = 'Dijadwalkan';

        // Create the interview
        Interview::create($validatedData);

        // Redirect based on user role
        if (Auth::user()->role_id == Role::IS_STUDENT) {
            return redirect()->route('student.dashboard')->with('success', 'Interview created successfully.');
        } else {
            return redirect()->route('interview.index')->with('success', 'Interview created successfully.');
        }
    }

    public function show(Interview $interview, $slug)
    {
        $interview = Interview::where('slug', $slug)->firstOrFail();
        return view('Interviews.show', compact('interview'));
    }

    public function edit(Interview $interview, $slug)
    {
        $users = User::all();
        $interview = Interview::where('slug', $slug)->firstOrFail();
        return view('Interviews.edit', compact('interview', 'users'));
    }


    public function update(Request $request, $slug)
    {
        $interview = Interview::where('slug', $slug)->firstOrFail();

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

    public function accept($slug)
    {
        $interview = Interview::where('slug', $slug)->firstOrFail();
        $interview->status = 'Selesai';
        $interview->save();
        return redirect()->back();
    }

    public function setZoom(Request $request, $slug,)
    {
        $interview = Interview::where('slug', $slug)->firstOrFail();
        $interview->link = $request->input('link');
        $interview->save();
        return redirect()->back();
    }
}
