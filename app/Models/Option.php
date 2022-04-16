<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    use Translatable;
    protected $fillable = ['attribute_id','product_id','price'];
    protected $with = ['translations'];
    

    public $translatedAttributes = ['name'];



    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

}
