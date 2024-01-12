<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParentAddress extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function studentParent()
    {
        return $this->belongsTo(StudentParent::class);
    }
}
