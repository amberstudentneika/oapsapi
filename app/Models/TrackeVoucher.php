<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackeVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'eVoucherPaymentDetailsID',
        'canteenStaffID',
        'RemainingUsage',
        'date',
        'status',
    ];

    public function canteenStaff(){
        return $this->belongsTo(canteenStaff::class,'canteenStaffID');
    }
    public function eVoucherPaymentDetails(){
        return $this->belongsTo(eVoucherPaymentDetails::class,'eVoucherPaymentDetailsID');
    }
}
