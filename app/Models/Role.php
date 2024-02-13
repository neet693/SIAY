<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const IS_ADMIN = 1;
    public const IS_STUDENT = 2;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
