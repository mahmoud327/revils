<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{

    use HasFactory;
    use \Astrotomic\Translatable\Translatable;


    protected $translationForeignKey = "business_type_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Core\Translation\BusinessType';


    protected $guarded = [];
}
