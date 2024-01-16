<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'nickname',
        'citizenship',
        'gender',
        'birth_place',
        'birth_date',
        'religion_id',
        'church_domicile',
        'child_position',
        'child_number',
        'blood_type_id',
        'email',
        'residence_status_id',
        'dad_tel',
        'mom_tel'
    ];

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function schoolInformation()
    {
        return $this->belongsTo(SchoolInformation::class);
    }

    public function studentAddress()
    {
        return $this->hasOne(StudentAddress::class)->withDefault();
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function residenceStatus()
    {
        return $this->belongsTo(ResidenceStatus::class);
    }

    public function studentParent()
    {
        return $this->hasMany(StudentParent::class);
    }
}
