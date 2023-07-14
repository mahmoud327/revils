<?php

namespace App\Models\Core;

use App\Models\Core\Translation\Category as TranslationCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use \Astrotomic\Translatable\Translatable;

    use HasFactory;



    protected $translationForeignKey = "category_id";
    public $translatedAttributes = ['name','description'];
    public $translationModel = 'App\Models\Core\Translation\Category';



    protected $guarded = ['id'];

    public function translations()
    {
        return $this->hasMany(TranslationCategory::class);
    }

}
