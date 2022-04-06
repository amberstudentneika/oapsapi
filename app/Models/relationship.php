<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentID',
        'parentID',
        'relationID',
        'birthCertificate',
        'status',
        'admin',
    ];

    public function student(){
        return $this->belongsTo(student::class,'studentID');
    }
    public function parent(){
        return $this->belongsTo(parents::class,'parentID');
    }
    public function relation(){
        return $this->belongsTo(relation::class,'relationID');
    }

    public function eVoucherPaymentDetails(){
        return $this->hasMany(eVoucherPaymentDetails::class,'RelationshipID');
    }
}
