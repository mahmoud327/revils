<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasTranslations;
    use LogsActivity;
    use InteractsWithMedia;


    use HasFactory;

    public $translatable = ['name', 'description'];


    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function getImageAttribute()
    {
        if (($images = $this->getMedia('categories'))->count()) {
            return asset(optional($this->getFirstMedia('categories'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }
}
