<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{

    use HasTranslations;
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];
    public $translatable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes');
    }
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
}
