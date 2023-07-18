<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{


    use HasFactory;
    use HasTranslations;
    public $translatable = ['value'];

    protected $guarded = [];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
