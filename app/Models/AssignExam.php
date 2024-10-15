<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignExam extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    // Dalam model AssignedExam
    public function scores()
    {
        return $this->hasMany(Score::class, 'exam_id'); // Pastikan ini sesuai dengan kolom yang kamu gunakan
    }
}
