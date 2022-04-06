<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eVoucherPaymentDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'RelationshipID',
        'type',
        'totalCost',
        'amountPaid',
        'nameOnCard',
        'cardNum',
        'expDate',
        'secCode',
        'totalAllotment',
        'voucherNumber'
    ];

    public function relationship(){
        return $this->belongsTo(Relationship::class,'RelationshipID');
    }

    public function trackVouchers(){
        return $this->hasMany(TrackeVoucher::class,'eVoucherPaymentDetailsID');
    }
    

}
