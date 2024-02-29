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
        'parentStay',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function setParentStayAttribute($value)
    {
        $convertedValue = $this->convertParentStay($value);
        $this->attributes['parentStay'] = $convertedValue;
    }

    protected function convertParentStay($method)
    {
        // Konversi nilai degree ke gelar sesuai kebutuhan
        switch ($method) {
            case 1:
                return 'Rumah Pribadi';
            case 2:
                return 'Apartemen';
            case 3:
                return 'Kontrak';
            case 4:
                return 'Kost';
        }
    }
}
