<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Interview extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title',
        'interview_date',
        // 'start_time',
        // 'end_time',
        'method',
        'status',
        'user_id',
        'reason',
        'link'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'interview_date' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
