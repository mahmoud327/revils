<?php

namespace App\Models\Order;

use App\Models\Core\Payment;
use App\Models\UserAddress;
use App\Models\UserCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;


    protected $guarded = [];



    /**
     * ----------------------------------------------------------------- *
     * --------------------------- Relations --------------------------- *
     * ----------------------------------------------------------------- *.
     */


    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class)->with('product');
    }

    public function userAddress(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->belongsToMany(UserCart::class, 'cart_order');
    }

    protected static function booted()
    {
        static::saving(function (Order $order) {
            if ($order->amount < 0) {
                $order->amount = 0;
                $order->save();
            }
        });
    }
}
