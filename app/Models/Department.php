<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function mall(){
        return $this->belongsTo(Mall::class,'mall_id');
     }
     public function vendors(){
        return $this->hasMany(Vendor::class,'department_id');
     }
}
