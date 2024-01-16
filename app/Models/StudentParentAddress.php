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
    ];

    public function studentParent()
    {
        return $this->belongsTo(StudentParent::class);
    }
}
