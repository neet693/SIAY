<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
