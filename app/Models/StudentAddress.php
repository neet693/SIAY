<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_province',
        'student_regency',
        'student_district',
        'student_village',
        'address',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
