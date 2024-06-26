<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded =  ['id'];

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

    public function responses()
    {
        return $this->hasMany('App\Models\Response');
    }
}
