<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'identificationCard',
        'trn',
        'address',
        'email',
        'password',
        // 'birthCertificate',
        // 'approvedBy',
    ];

    public function relationships(){
        return $this->hasMany(parents::class,'parentID');
    }
}
