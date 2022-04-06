<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];
    
    public function relationship(){
        return $this->hasMany(relation::class,'relationID');
    }
}
