<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    use \Astrotomic\Translatable\Translatable;

    use HasFactory;

    protected $with = [
        'translations',
    ];

    protected $translationForeignKey = "attribute_id";
    public $translatedAttributes = ['name'];

    public $translationModel = 'App\Models\Product\Translation\Attribute';


    protected $guarded = [];



    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class,'attribute_id');
    }
}
