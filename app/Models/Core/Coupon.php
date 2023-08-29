<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Coupon extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = ['id'];


    public function scopeVaild($q)
    {
        return  $q->where('expiry_date', '>=', now());
    }


    public function discount($total)
    {
        if ($this->type == 'amount') {
            return $this->value;
        } elseif ($this->type == 'percentage') {
            return ($this->value / 100) * $total;
        } else {
            return 0;
        }

    }


    public function  getUserUsedCouponAttribute()
    {
        return  CouponUser::query()
            ->whereUserId(auth()->id())
            ->whereCouponId($this->id)
            ->exists();
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll();

    }

}
