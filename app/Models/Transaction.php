<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'transaction_type_id',
        //'snap_token',
        //'is_success',
        'payment_status',
        'midtrans_url',
        'midtrans_booking_code',
        'price'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }
}
