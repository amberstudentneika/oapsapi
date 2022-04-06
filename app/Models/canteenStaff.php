<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class canteenStaff extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'firstname',
        'lastname',
        'gender',
        'email',
        'password',
        'status',
    ];

    public function trackVouchers(){
        return $this->hasMany(TrackVouchers::class,'canteenStaffID');
    }
}
