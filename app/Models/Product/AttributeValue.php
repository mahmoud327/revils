<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{

    use \Astrotomic\Translatable\Translatable;

    use HasFactory;

    protected $with = [
        'translations',
    ];

    protected $translationForeignKey = "attribute_value_id";
    public $translatedAttributes = ['value'];

    public $translationModel = 'App\Models\Product\Translation\AttributeValue';


    protected $guarded = [];
}
