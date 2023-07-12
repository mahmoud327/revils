<?php

namespace App\Models\Core\Translation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;

    protected $table = "business_type_translations";

    protected $guarded = [];

}
