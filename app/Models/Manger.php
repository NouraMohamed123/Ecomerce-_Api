<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manger extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['password'];

    public function getPhotoAttribute($value){
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'images/manager/' . $value);
    }

    public function malls(){
       return $this->hasMany(Mall::class,'manager_id');
    }
}
