<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParentAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_parent_id',
        'parent_province',
        'parent_regency',
        'parent_district',
        'parent_village',
        'address',
        'parentStay'
    ];

    public function studentParent()
    {
        return $this->belongsTo(StudentParent::class);
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
