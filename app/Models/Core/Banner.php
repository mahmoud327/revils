<?php

namespace App\Models\Core;

use App\Http\Resources\Core\MediaCenterResource;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cron\ByClick;
use App\Models\Cron\ByTime;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Banner extends Model implements HasMedia
{

    use HasTranslations;
    use InteractsWithMedia;

    public $translatable = ['title', 'description'];
    protected $guarded = ['id'];
    protected $table = "banners";


    /*
     * ----------------------------------------------------------------- *
     * --------------------------- Acessores --------------------------- *
     * ----------------------------------------------------------------- *
     */


    public function getImageAttribute()
    {
        return asset(optional($this->getFirstMedia('banners'))->getUrl());
    }

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }
}
