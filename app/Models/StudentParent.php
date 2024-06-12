<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'dad_name',
        'mom_name',
        'dad_degree',
        'mom_degree',
        'dad_job',
        'mom_job',
        'dad_tel',
        'mom_tel',
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function studentParentAddress()
    {
        return $this->hasOne(StudentParentAddress::class, 'student_parent_id');
    }


    public function getDadDegreeAttribute()
    {
        return $this->convertDegree($this->attributes['dad_degree']);
    }

    public function getMomDegreeAttribute()
    {
        return $this->convertDegree($this->attributes['mom_degree']);
    }

    protected function convertDegree($degree)
    {
        // Konversi nilai degree ke gelar sesuai kebutuhan
        switch ($degree) {
            case 1:
                return 'SD';
            case 2:
                return 'SMP';
            case 3:
                return 'SMA';
            case 4:
                return 'D1';
            case 5:
                return 'D2';
            case 6:
                return 'D3';
            case 7:
                return 'S1';
            case 8:
                return 'S2';
            case 9:
                return 'S3';
            default:
                return 'Tidak Diketahui';
        }
    }
}
