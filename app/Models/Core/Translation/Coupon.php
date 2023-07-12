<?php

namespace App\Models\Core\Translation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    use \Astrotomic\Translatable\Translatable;

    use HasFactory;


    protected $table = "coupon_translations";


    protected $guarded = [];
}
