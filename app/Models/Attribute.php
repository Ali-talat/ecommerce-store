<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    use Translatable;
    protected $guarded = [];
    
    protected $with = ['translations'];
    

    public $translatedAttributes = ['name'];


    public function option()
    {
        return $this->belongsTo(Option::class, 'attribute_id');
    }
    


}
