<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{

    use HasTranslations;
    use InteractsWithMedia;

    public $translatable = ['about_us', 'terms_condition'];
    protected $guarded = ['id'];
    protected $table = "settings";


    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Acessores --------------------------- *
     * ----------------------------------------------------------------- *
     */


    
}
