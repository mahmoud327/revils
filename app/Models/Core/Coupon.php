<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    use \Astrotomic\Translatable\Translatable;

    use HasFactory;



    protected $translationForeignKey = "coupon_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Core\Translation\Coupon';


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
}
