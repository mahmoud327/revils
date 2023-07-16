<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    use HasFactory;

    public $translatable = ['name', 'description'];


    protected $guarded = ['id'];


}
