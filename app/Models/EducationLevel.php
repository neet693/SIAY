<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;

    protected $fillable = ['level_name'];

    public function schoolInformation()
    {
        return $this->hasMany(SchoolInformation::class);
    }
}
