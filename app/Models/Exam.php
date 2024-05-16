<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'schedule_at' => 'date',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function responses()
    {
        return $this->hasMany('App\Models\Response');
    }

    public function assignedStudents()
    {
        return $this->belongsToMany(User::class, 'assign_exams', 'exam_id', 'student_id');
    }
}
