<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
}
