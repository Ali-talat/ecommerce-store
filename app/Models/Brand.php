<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['photo','active'];
    protected $with = ['translations'];
    protected $casts = [
        'active' => 'boolean',
    ];

    public $translatedAttributes = ['name'];



    public function scopeActive($query){
        return $query -> where('active',1) ;
    }

    
    public function getActive(){
        return  $this -> active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }



    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";
    }


}
