<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'identificationNumber',
        'firstname',
        'lastname',
        'gender',
        'dob',
        'address',
        'grade',
        'class',
        'birthCertificate',
        'status'
    ];

    public function relationships(){
        return $this->hasMany(relationship::class,'studentID');
    }
}
