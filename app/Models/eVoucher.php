<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'fixedPrice',
        'AdministratorID',
    ];

    public function user(){
        return $this->belongsTo(User::class,'AdministratorID');
    }
}
