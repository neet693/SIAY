<?php

namespace App\Http\Controllers;

use App\Models\PPDB;
use App\Models\SchoolInformation;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentParent;
use App\Models\StudentParentAddress;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PPDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('PPDB.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'education_level_id' => 'required',
            'academic_year_id' => 'required',
            'news_from' => 'required',
            'last_school' => 'required',
            'fullname' => 'required',
            'nickname' => 'required',
            'citizenship' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'religion_id' => 'required',
            'church_domicile' => 'required',
            'student_province' => 'required',
            'student_regency' => 'required',
            'student_district' => 'required',
            'student_village' => 'required',
            'address' => 'required',
            'child_position' => 'required',
            'child_number' => 'required',
            'blood_type_id' => 'required',
            'email' => 'required|email',
            'residence_status_id' => 'required',
            'dad_tel' => 'required',
            'mom_tel' => 'required',
            'dad_name' => 'required',
            'mom_name' => 'required',
            'dad_degree' => 'required',
            'mom_degree' => 'required',
            'dad_job' => 'required',
            'mom_job' => 'required',
            'parent_province' => 'required',
            'parent_regency' => 'required',
            'parent_district' => 'required',
            'parent_village' => 'required',
            'address' => 'required',
        ]);

        $schoolInformation = SchoolInformation::create([
            'academic_year_id' => $request->input('academic_year_id'),
            'education_level_id' => $request->input('education_level_id'),
            'news_from' => $request->input('news_from'),
            'last_school' => $request->input('last_school'),
        ]);
        $schoolInformation->save();

        // Step 2: Save Student Information
        $student = Student::create([
            'school_information_id' => $schoolInformation->id,
            'fullname' => $request->input('fullname'),
            'nickname' => $request->input('nickname'),
            'citizenship' => $request->input('citizenship'),
            'gender' => $request->input('gender'),
            'birth_place' => $request->input('birth_place'),
            'birth_date' => $request->input('birth_date'),
            'religion_id' => $request->input('religion_id'),
            'church_domicile' => $request->input('church_domicile'),
            'child_position' => $request->input('child_position'),
            'child_number' => $request->input('child_number'),
            'blood_type_id' => $request->input('blood_type_id'),
            'email' => $request->input('email'),
            'residence_status_id' => $request->input('residence_status_id'),
        ]);
        $student->studentAddress()->create([
            'student_province' => $request->input('student_province_name'),
            'student_regency' => $request->input('student_regency_name'),
            'student_district' => $request->input('student_district_name'),
            'student_village' => $request->input('student_village_name'),
            'address' => $request->input('address'),
        ]);

        // Step 3: Save Student Parent Information
        $studentParent = StudentParent::create([
            'student_id' => $student->id,
            'dad_name' => $request->input('dad_name'),
            'mom_name' => $request->input('mom_name'),
            'dad_degree' => $request->input('dad_degree'),
            'mom_degree' => $request->input('mom_degree'),
            'dad_job' => $request->input('dad_job'),
            'mom_job' => $request->input('mom_job'),
            'dad_tel' => $request->input('dad_tel'),
            'mom_tel' => $request->input('mom_tel'),
        ]);
        $studentParent->studentParentAddress()->create([
            'parent_province' => $request->input('parent_province_name'),
            'parent_regency' => $request->input('parent_regency_name'),
            'parent_district' => $request->input('parent_district_name'),
            'parent_village' => $request->input('parent_village_name'),
            'address' => $request->input('address'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $step)
    {
        $step = $request->input('step', 1);

        // Tampilkan view sesuai dengan langkah
        return view('PPDB.step1');
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
