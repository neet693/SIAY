<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Models\SchoolInformation;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\StudentParentAddress;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     Student::factory(10)->create();
    // }

    public function run()
    {
        // Create User
        // $user = User::create([
        //     'name' => 'John Doe',
        //     'email' => 'john.doe@example.com',
        //     'role_id' => 3,
        //     'password' => bcrypt('sekolahyahya*'),
        // ]);

        // // Create School Information
        // $schoolInformation = SchoolInformation::firstOrCreate([
        //     'academic_year_id' => 1, // Change as needed
        //     'education_level_id' => 1, // Change as needed
        //     'news_from' => 'Previous School',
        //     'last_school' => 'Previous School Name',
        // ]);

        // // Generate Unique Code
        // $academicYear = substr($schoolInformation->academicYear->name, 2, 2) . substr($schoolInformation->academicYear->name, -2, 2);
        // $uniqueCode = $schoolInformation->educationLevel->level_name . '-' . $academicYear . '-' .  sprintf("%04d", $schoolInformation->id);

        // // Create Student
        // $student = Student::create([
        //     'user_id' => $user->id,
        //     'school_information_id' => $schoolInformation->id,
        //     'unique_code' => $uniqueCode,
        //     'fullname' => 'John Doe',
        //     'nickname' => 'Johnny',
        //     'citizenship' => 'Indonesian',
        //     'gender' => 'Male',
        //     'birth_place' => 'Jakarta',
        //     'birth_date' => '2005-05-10', // Change as needed
        //     'religion_id' => 1, // Change as needed
        //     'church_domicile' => 'Jakarta',
        //     'child_position' => 1,
        //     'child_number' => 1,
        //     'blood_type_id' => 1, // Change as needed
        //     'email' => 'john.doe@example.com',
        //     'residence_status_id' => 1, // Change as needed
        //     'status_penerimaan' => 'Menunggu Persetujuan',
        // ]);

        // // Create Student Parent
        // $studentParent = StudentParent::create([
        //     'student_id' => $student->id,
        //     'dad_name' => 'John Dad',
        //     'mom_name' => 'Jane Mom',
        //     'dad_degree' => 3,
        //     'mom_degree' => 3,
        //     'dad_job' => 'Engineer',
        //     'mom_job' => 'Teacher',
        //     'dad_tel' => '123456789',
        //     'mom_tel' => '987654321',
        // ]);

        // // Create Student Parent Address
        // $studentParentAddress = StudentParentAddress::create([
        //     'student_parent_id' => $studentParent->id,
        //     'parent_province' => 'DKI Jakarta',
        //     'parent_regency' => 'Jakarta Pusat',
        //     'parent_district' => 'Tanah Abang',
        //     'parent_village' => 'Karet Tengsin',
        //     'address' => 'Jl. Jenderal Sudirman No. 10',
        //     'parentStay' => 'Orang Tua',
        // ]);

        // $interview = Interview::create([
        //     'title' => 'Interview Title',
        //     'interview_date' => '2024-05-20', // Change as needed
        //     // 'start_time' => '09:00', // Change as needed
        //     // 'end_time' => '10:00', // Change as needed
        //     'method' => 'Offline', // Change as needed
        //     'reason' => 'Assessment', // Change as needed
        //     'user_id' => $user->id,
        // ]);

        // If residence status is Wali
        // $wali = Wali::create([
        //     'student_id' => $student->id,
        //     'wali_name' => 'Wali Name',
        //     'wali_degree' => 'Bachelor',
        //     'wali_job' => 'Wali Job',
        //     'wali_address' => 'Wali Address',
        //     'wali_tel' => 'Wali Telephone',
        // ]);
    }
}
