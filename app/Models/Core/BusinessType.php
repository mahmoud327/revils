<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BusinessType extends Model
{

    use HasFactory;
    use HasTranslations;
    public $translatable = ['name', 'description'];
    protected $guarded = [];
}
