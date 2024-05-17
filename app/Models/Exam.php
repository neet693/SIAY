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
        return $this->belongsToMany(Student::class, 'assign_exams', 'exam_id', 'student_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'assigned_students', 'exam_id', 'student_id')
            ->withPivot('score');
    }

    public function score($student)
    {
        $questions = $this->questions;
        $studentScore = 0;
        foreach ($questions as $question) {
            $answer = $question->options()->where('is_correct', 1)->first();
            $studentAnswer = $student->answers()
                ->where('question_id', $question->id)
                ->first();
            if ($studentAnswer && $studentAnswer->option_id == $answer->id) {
                $studentScore += $question->point;
            }
        }
        return $studentScore;
    }
}
