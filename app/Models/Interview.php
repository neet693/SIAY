<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title',
        'interview_date',
        'start_time',
        'end_time',
        'method',
        'status',
        'user_id',
        'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
