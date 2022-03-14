<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getPhotoAttribute($value){
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'assets/mail/' . $value);
    }
    public function manger(){
        return $this->belongsTo(Manger::class,'manager_id');
     }
     public function departments(){
        return $this->hasMany(Department::class,'mall_id');
     }
}
