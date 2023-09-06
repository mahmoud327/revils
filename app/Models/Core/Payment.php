<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Payment  extends Model implements HasMedia
{
    use LogsActivity;
    use InteractsWithMedia;

    use HasFactory;
    protected $guarded = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function getImageAttribute()
    {
        if (($images = $this->getMedia('payments'))->count()) {
            return asset(optional($this->getFirstMedia('payments'))->getUrl());
        }
        return asset('awarebox.jpeg');
    }
}
