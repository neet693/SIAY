<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'wali_name',
        'wali_degree',
        'wali_job',
        'wali_address',
        'wali_tel'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getWaliDegreeAttribute()
    {
        return $this->convertDegree($this->attributes['wali_degree']);
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
