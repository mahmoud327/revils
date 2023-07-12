<?php

namespace App\Models\Product\Translation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $table = "attribute_value_translations";

    protected $guarded = [];

}
