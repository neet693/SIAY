<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolInformation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function edulevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function academicyear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
