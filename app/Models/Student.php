<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_information_id',
        'unique_code',
        'user_id',
        'fullname',
        'nickname',
        'citizenship',
        'gender',
        'birth_place',
        'birth_date',
        'religion_id',
        'church_domicile',
        'child_position',
        'child_number',
        'blood_type_id',
        'email',
        'residence_status_id',
        // 'payment_method',
        'status_penerimaan',
        // 'snap_token',
        // 'payment_status',
    ];

    protected $casts = [
        'birth_date' => 'datetime'
    ];

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function schoolInformation()
    {
        return $this->belongsTo(SchoolInformation::class);
    }

    public function studentAddress()
    {
        return $this->hasOne(StudentAddress::class)->withDefault();
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function residenceStatus()
    {
        return $this->belongsTo(ResidenceStatus::class);
    }

    public function studentParent()
    {
        return $this->hasMany(StudentParent::class);
    }

    public function wali()
    {
        return $this->hasOne(Wali::class);
    }

    public function setPaymentMethodAttribute($value)
    {
        $convertedValue = $this->convertPayment($value);
        $this->attributes['payment_method'] = $convertedValue;
    }

    protected function convertPayment($method)
    {
        // Konversi nilai degree ke gelar sesuai kebutuhan
        switch ($method) {
            case 1:
                return 'Tunai';
            case 2:
                return 'Transfer';
        }
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(transactionType::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
