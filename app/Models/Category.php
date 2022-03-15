<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Translatable;

    protected $with = ['translations'];
    protected $fillable = ['parent_id','slug','active'] ;
    protected $translatedAttributes = ['name'];
    // protected $hidden = ['translation'];
    protected $casts = ['active'=>'boolean'];

    public function getActive(){
       return $this->active == 0 ? 'غير مفعل ': 'مفعل' ;
    }

    
    public function _parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
   
    

    
}
